<?php
// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Key;
use App\Models\Cart;
use Midtrans\Config;
use App\Models\Invoice;
use App\Models\UserKey;
use App\Models\CartItem;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function checkout(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.sanitize');
        Config::$is3ds = config('midtrans.3ds');

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $selectedKeyIds = $request->input('selected_items', []);

        if (empty($selectedKeyIds)) {
            return redirect()->back()->with('error', 'Pilih minimal satu item untuk checkout.');
        }

        $cart = Cart::where('user_id', $user->user_id)
                    ->where('status', 'active')
                    ->first();

        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Cart kamu kosong.');
        }

        // Ambil item yang dipilih saja
        $items = $cart->cartItems()->whereIn('key_id', $selectedKeyIds)->with('key')->get();

        $grossAmount = 0;
        foreach ($items as $item) {
            $grossAmount += $item->harga_satuan * $item->quantity;
        }

        if ($grossAmount <= 0) {
            return redirect()->back()->with('error', 'Total checkout tidak valid.');
        }
            $transactionDetails = [
            'order_id' => 'ORDER-' . uniqid(),
            'gross_amount' => $grossAmount,
        ];

        $request->session()->put('checkout_key_ids', $selectedKeyIds); // Simpan ke session jika perlu

        $customerDetails = [
            'first_name' => $user->nama_user ?? 'Guest',
            'email' => $user->user_email ?? 'guest@example.com',
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('payment.midtrans', compact('snapToken', 'transactionDetails'));


        // Jika cart sudah kosong, hapus cartnya
        if ($cart->cartItems()->count() == 0) {
            $cart->delete();
        }

        $transactionDetails = [
            'order_id' => 'ORDER-' . uniqid(),
            'gross_amount' => $grossAmount,
        ];

        $customerDetails = [
            'first_name' => $user->nama_user ?? 'Guest',
            'email' => $user->user_email ?? 'guest@example.com',
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('payment.midtrans', compact('snapToken'));
    }

    public function addToCart($keyId)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login')->with('error', 'Silakan login dulu.');
        }

        $cart = Cart::firstOrCreate(
            ['user_id' => $user->user_id, 'status' => 'active'],
            ['created_at' => now(), 'updated_at' => now()]
        );

        $cartItem = CartItem::where('cart_id', $cart->cart_id)
                            ->where('key_id', $keyId)
                            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            $key = Key::findOrFail($keyId);
            CartItem::create([
                'cart_id' => $cart->cart_id,
                'key_id' => $keyId,
                'quantity' => 1,
                'harga_satuan' => $key->harga_key,
            ]);
        }

        return redirect()->back()->with('success', 'Key berhasil ditambahkan ke cart!');
    }

    public function showCart()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login')->with('error', 'Silakan login dulu.');
        }

        $cart = Cart::where('user_id', $user->user_id)
                    ->where('status', 'active')
                    ->first();

        if (!$cart) {
            return view('cart', ['cartItems' => [], 'cartTotal' => 0]);
        }

        $items = $cart->cartItems()->with('key')->get();

        $cartItems = $items->map(function ($item) {
            return [
                'key_id' => $item->key_id,
                'name' => $item->key->nama_key,
                'quantity' => $item->quantity,
                'harga_satuan' => $item->harga_satuan,
                'total' => $item->quantity * $item->harga_satuan,
            ];
        });

        $cartTotal = $cartItems->sum('total');

        return view('cart', compact('cartItems', 'cartTotal'));
    }

    public function updateQuantity(Request $request, $keyId)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $user = Auth::user();
        if (!$user) return response()->json(['error' => 'Login dulu!'], 403);

        $cart = Cart::where('user_id', $user->user_id)->where('status', 'active')->first();
        if (!$cart) return response()->json(['error' => 'Cart tidak ditemukan.'], 404);

        $cartItem = CartItem::where('cart_id', $cart->cart_id)->where('key_id', $keyId)->first();
        if (!$cartItem) return response()->json(['error' => 'Item tidak ditemukan di cart.'], 404);

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['success' => 'Quantity berhasil diperbarui.']);
    }

    public function removeFromCart($keyId)
    {
        $user = Auth::user();
        if (!$user) return redirect('/login')->with('error', 'Silakan login dulu.');

        $cart = Cart::where('user_id', $user->user_id)->where('status', 'active')->first();
        if (!$cart) return redirect()->back()->with('error', 'Cart tidak ditemukan.');

        $cartItem = CartItem::where('cart_id', $cart->cart_id)->where('key_id', $keyId)->first();
        if (!$cartItem) return redirect()->back()->with('error', 'Item tidak ditemukan di cart.');

        $cartItem->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari cart.');
    }

    public function paymentSuccess(Request $request)
    {
        $user = Auth::user();
        if (!$user) return response()->json(['error' => 'Unauthorized'], 401);

        $cart = Cart::where('user_id', $user->user_id)->where('status', 'active')->first();
        if (!$cart) return response()->json(['error' => 'Cart tidak ditemukan.'], 404);

        $selectedKeyIds = session('checkout_key_ids', []);
        $items = $cart->cartItems()->whereIn('key_id', $selectedKeyIds)->with('key')->get();


        $invoice = Invoice::create([
            'user_id' => $user->user_id,
            'kode_invoice' => '',
            'total_price' => $request->gross_amount,
            'status' => 'paid',
        ]);

        $kodeInvoice = 'INV' . str_pad($invoice->invoices_id, 4, '0', STR_PAD_LEFT);
        $invoice->kode_invoice = $kodeInvoice;
        $invoice->save();

        foreach ($items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->invoices_id,
                'key_id' => $item->key_id,
                'quantity' => $item->quantity,
                'harga_satuan' => $item->harga_satuan,
                'total_price' => $item->harga_satuan * $item->quantity,
            ]);

            $userKey = UserKey::where('user_id', $user->user_id)
                            ->where('key_id', $item->key_id)
                            ->first();

            if ($userKey) {
                $userKey->jumlah += $item->quantity;
                $userKey->save();
            } else {
                UserKey::create([
                    'user_id' => $user->user_id,
                    'key_id' => $item->key_id,
                    'jumlah' => $item->quantity
                ]);
            }

            $item->delete();
        }

        if ($cart->cartItems()->count() == 0) {
            $cart->delete();
        }
        $request->session()->forget('checkout_key_ids');
        return response()->json(['success' => true]);
    }

}
