<?php

namespace App\Http\Controllers;

use App\Models\Key;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    // Halaman home
    public function home()
    {
        return view('home');
    }

    // Tampilkan halaman store dengan data keys dan fitur search
    public function showStore(Request $request)
    {
        $query = $request->input('query');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $keys = Key::where('delete_key', 'N');

        if ($query) {
            $keys->where('nama_key', 'like', "%{$query}%");
        }

        if ($minPrice !== null) {
            $keys->where('harga_key', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $keys->where('harga_key', '<=', $maxPrice);
        }

        $keys = $keys->get();

        return view('store', compact('keys'));
    }


    // Tampilkan halaman input key (form tambah key)
    public function insert_key()
    {
        return view('inputkey');
    }

    // Notifikasi setelah input key berhasil (dummy)
    public function notif_key()
    {
        return redirect()->route('store')->with('success', 'Key berhasil disimpan (dummy).');
    }
    public function filter_price()
    {
        
    }
}
