<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class salescontroller extends Controller
{
    //
//     public function index()
// {
//     $user = Auth::user();

//     if ($user->user_role !== 'seller') {
//         abort(403, 'Unauthorized access');
//     }

//     $invoices = Invoice::with(['user', 'items.key'])
//         ->whereHas('items.key', function($query) use ($user) {
//             $query->where('kode_user', $user->kode_user);
//         })
//         ->orderBy('created_at', 'desc')
//         ->get();

//     return view('sales', compact('invoices'));
// }

public function index()
{
    $user = Auth::user();

    if ($user->user_role !== 'seller') {
        abort(403, 'Unauthorized access');
    }

    $penjualan = DB::table('invoice_items')
        ->join('shop_key', 'invoice_items.key_id', '=', 'shop_key.id')
        ->join('invoices', 'invoice_items.invoice_id', '=', 'invoices.invoices_id')
        ->join('users', 'invoices.user_id', '=', 'users.user_id')
        ->where('shop_key.kode_user', $user->kode_user)
        ->select(
            'invoice_items.*',
            'shop_key.nama_key',
            'users.nama_user',
            'invoices.kode_invoice',
            'invoices.created_at as tanggal_invoice',
            'invoices.status'
        )
        ->orderBy('invoices.created_at', 'desc')
        ->get();

    return view('sales', compact('penjualan'));
}


}
