<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Key;
use App\Models\UserKey;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * Tampilkan inventory user dengan data dummy.
     */
    // public function index()
    // {
    //     // Dummy data untuk testing
    //     $items = [
    //         [
    //             'name' => 'Dust Crate',
    //             'rarity' => 'Rare',
    //             'quantity' => 2,
    //             'acquired_at' => Carbon::now()->subDays(3),
    //         ],
    //         [
    //             'name' => 'Ironfang Cache',
    //             'rarity' => 'Elite',
    //             'quantity' => 1,
    //             'acquired_at' => Carbon::now()->subDays(1),
    //         ],
    //         [
    //             'name' => 'Celestia Relic',
    //             'rarity' => 'Divine',
    //             'quantity' => 1,
    //             'acquired_at' => Carbon::now()->subHours(5),
    //         ],
    //     ];

    //     return view('inventory', compact('items'));
    // }

   public function showInventory()
    {
        $user = Auth::user();

        $userKeys = UserKey::with('key')
                    ->where('user_id', $user->user_id)
                    ->where('jumlah','>',0)
                    ->get();

        $items = $userKeys->map(function ($userKey) {
            return [
                'name' => $userKey->key->nama_key ?? 'Unknown Key',
                'rarity' => $userKey->Key->jenis_key ?? 'Unknown',
                'quantity' => $userKey->jumlah,
                'acquired_at' => $userKey->updated_at, // atau created_at tergantung kebutuhan
            ];
        });

        return view('inventory', compact('items'));
    }
}