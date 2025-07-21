<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class boxcontroller extends Controller
{
    //
    public function insert_box(Request $request)
    {
        
     return view('inputbox');
    }

    public function notif_box(Request $request)
    {
        
     return redirect()->route('crates')->with('success', 'box berhasil disimpan (dummy).');
    }

}