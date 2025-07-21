<?php

// app/Http/Controllers/HistoryController.php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = [
            [
                'id' => 12345,
                'name' => 'Nebula Vault',
                'rarity' => 'Epic',
                'quantity' => 2,
                'reward' => 'Voucher Steam Rp. 12.000',
            ],
            // Tambahkan data lainnya di sini...
        ];

        return view('history', compact('histories'));
    }

    public function showOrder($id)
    {
        $order = [
            'id' => $id,
            'date' => now(),
            'box_name' => 'Nebula Vault',
            'rarity' => 'Epic',
            'quantity' => 2,
            'total' => 240000,
            'reward' => 'Voucher Steam Rp. 12.000',
        ];

        return view('order-details', compact('order'));
    }



    public function showHistory()
        {
            $user = Auth::user();

            // Ambil invoice yang sudah dibayar beserta item & key-nya
            $invoices = Invoice::with(['items.key'])
                        ->where('user_id', $user->user_id)
                        ->where('status', 'paid')
                        ->orderBy('created_at', 'desc')
                        ->get();

            return view('history', compact('invoices'));
        }


}