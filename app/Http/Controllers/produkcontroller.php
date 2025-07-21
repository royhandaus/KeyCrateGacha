<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class produkcontroller extends Controller
{
    public function show_produk(Request $request)
    {
        $query = Produk::query();

        if ($request->has('out_of_stock')) {
            $query->where('stok_produk', '<=', 0);
        }

        if ($request->has('inactive')) {
            $query->where('available_produk', 0);
        } else {
            // Default hanya produk aktif
            $query->where('available_produk', 1);
        }

        $products = $query->get();

        return view('product.productpage', compact('products'));
    }

    //
    public function produk(Request $request)
    {
         $request->validate([
            'nama_produk' => 'required|string|max:50',
            'stok_produk' => 'required|integer|min:0',
            'kode_redeem_produk' => 'nullable|string|max:255',
            'rating' => 'nullable|integer|min:0|max:5',
            'available_produk' => 'required|boolean',
        ]);

        $product = new Produk();
        $product->nama_produk = $request->nama_produk;
        $product->stok_produk = $request->stok_produk;
        $product->kode_redeem_produk = $request->kode_redeem_produk;
        $product->rating = $request->rating ?? 5;
        $product->available_produk =$request->available_produk;
        $product->save();

        $product->kode_produk = 'PRD' . str_pad($product->produk_id,4,0,STR_PAD_LEFT);
        $product->save();

        return redirect()->route('product')->with('success','new Product has been added');

    }

 public function show_produk()
{
    // Menampilkan hanya produk yang tersedia
    $products = Produk::where('available_produk', 1)->get();
    return view('product.productpage', compact('products'));
}


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:50',
            'stok_produk' => 'required|integer|min:0',
            'kode_redeem_produk' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:0|max:5',
            'available_produk' => 'required|boolean',
        ]);

        $product = Produk::findOrFail($id);
        $product->nama_produk = $request->nama_produk;
        $product->stok_produk = $request->stok_produk;
        $product->kode_redeem_produk = $request->kode_redeem_produk;
        $product->rating = $request->rating;
        $product->available_produk =$request->available_produk;
        $product->save();

        return redirect()->route('product')->with('success', 'Produk berhasil diupdate!');
    }

    public function edit($id)
    {
        $product = Produk::findOrFail($id);
        return view('product.editproduct', compact('product'));
    }

    public function disable($id)
{
    $product = Produk::findOrFail($id);
    $product->available_produk = 0; // Nonaktifkan produk
    $product->save();

    return redirect()->route('product')->with('success', 'Produk berhasil dinonaktifkan.');
}



}

