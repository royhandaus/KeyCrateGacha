<?php

namespace App\Http\Controllers;

use App\Models\Key;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Tampilkan semua wishlist user
    public function index()
    {
        $user = Auth::user();

        if (!$user) return redirect('/login')->with('error', 'Silakan login untuk melihat wishlist.');

        $wishlists = Wishlist::with('key')
            ->where('user_id', $user->user_id)
            ->get();

         return view('wishlist', compact('wishlists'));

    }

    // Tambahkan key ke wishlist
    public function add($keyId)
    {
        $user = Auth::user();

        if (!$user) return redirect('/login')->with('error', 'Login dulu untuk menyimpan wishlist.');

        // Cek apakah sudah ada
        $exists = Wishlist::where('user_id', $user->user_id)
                          ->where('key_id', $keyId)
                          ->exists();

        if ($exists) {
            return redirect()->back()->with('info', 'Key sudah ada di wishlist kamu.');
        }

        Wishlist::create([
            'user_id' => $user->user_id,
            'key_id' => $keyId
        ]);

        return redirect()->back()->with('success', 'Berhasil ditambahkan ke wishlist!');
    }

    // Hapus key dari wishlist
    public function remove($id)
    {
        $wishlist = Wishlist::findOrFail($id);

        if (Auth::user()->user_id  != $wishlist->user_id) {
            return redirect()->back()->with('error', 'Akses tidak diizinkan.');
        }

        $wishlist->delete();
        return redirect()->back()->with('success', 'Berhasil dihapus dari wishlist.');
    }
    // Pastikan model Cart kamu sesuai

    public function moveToCart($id)
    {
        $user = Auth::user();
        $wishlist = Wishlist::with('key')->findOrFail($id);

        // Cari cart aktif milik user
        $cart = Cart::firstOrCreate(
            ['user_id' => $user->user_id, 'status' => 'active'],
            ['created_at' => now(), 'updated_at' => now()]
        );

        // Cari item dalam cart
        $existingItem = CartItem::where('cart_id', $cart->cart_id)
                                ->where('key_id', $wishlist->key_id)
                                ->first();

        if ($existingItem) {
            $existingItem->quantity += 1;
            $existingItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->cart_id,
                'key_id' => $wishlist->key_id,
                'quantity' => 1,
                'harga_satuan' => $wishlist->key->harga_key,
            ]);
        }

        $wishlist->delete();

        return redirect()->back()->with('success', 'Item berhasil dipindahkan ke cart.');
    }

}