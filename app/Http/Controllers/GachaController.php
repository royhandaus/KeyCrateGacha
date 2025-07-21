<?php

namespace App\Http\Controllers;

use App\Models\Crate;
use App\Models\UserKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GachaController extends Controller
{
    public function unlock($crateId)
    {
        $user = Auth::user();
        $crate = Crate::findOrFail($crateId);
        $keyId = $crate->key_id;

        $userKey = UserKey::where('user_id', $user->user_id)
            ->where('key_id', $keyId)
            ->where('jumlah', '>', 0)
            ->first();

        if (!$userKey) {
            return response()->json([
                'success' => false,
                'message' => 'Kamu tidak memiliki key yang cocok.'
            ]);
        }

        $userKey->jumlah -= 1;
        $userKey->save();

        return response()->json([
            'success' => true,
            'message' => 'Key dikurangi, lanjutkan gacha di frontend.'
        ]);
    }
    public function sellerHistory()
    {
        $user = Auth::user();

        $histories = DB::table('gacha_histories as gh')
            ->join('crates as c', 'gh.crate_id', '=', 'c.id')
            ->join('users as u', 'gh.user_id', '=', 'u.user_id')
            ->where('c.owner_id', $user->kode_user) // 🔥 perbaikan di sini
            ->select('gh.*', 'c.name as crate_name', 'u.nama_user as user_name')
            ->orderByDesc('gh.created_at')
            ->get();

        return view('gacha.seller_history', compact('histories'));
    }




    public function storeHistory(Request $request)
    {
        try {
            $user = auth()->user();
            $crate = Crate::findOrFail($request->crate_id);
            $itemName = $request->item_name;
            $crateJustInactivated = false;

            // Kurangi stok item
            for ($i = 1; $i <= 5; $i++) {
                if ($crate->{'item'.$i.'_name'} === $itemName) {
                    $stokColumn = 'item'.$i.'_stok';
                    if ($crate->$stokColumn > 0) {
                        $crate->$stokColumn -= 1;
                        $crate->save();
                    }
                    break;
                }
            }

            // Cek apakah crate harus di-nonaktifkan
            for ($i = 1; $i <= 5; $i++) {
                if ($crate->{'item'.$i.'_stok'} <= 0) {
                    $crate->status = 'inactive';
                    $crate->save();
                    $crateJustInactivated = true;
                    break;
                }
            }

            // Simpan history
            DB::table('gacha_histories')->insert([
                'user_id' => $user->user_id, // bukan $user->id
                'crate_id' => $crate->id,
                'item_name' => $itemName,
                'item_image' => $request->item_image,
                'rate' => $request->rate,
                'created_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'crate_inactive' => $crateJustInactivated
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function checkKeyCount($crateId)
    {
        $crate = Crate::findOrFail($crateId);
        $user = Auth::user();

        $key = $user->userKeys()->whereHas('key', function ($q) use ($crate) {
            $q->where('nama_key', $crate->name);
        })->first();

        if ($key) {
            return response()->json([
                'success' => true,
                'remaining_keys' => $key->jumlah
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Key tidak ditemukan'
        ]);
    }

    private function randomItemByRate($items)
    {
        $totalRate = $items->sum('rate');
        $rand = mt_rand() / mt_getrandmax() * $totalRate;
        $cumulative = 0;

        foreach ($items as $item) {
            $cumulative += $item['rate'];
            if ($rand <= $cumulative) {
                return $item;
            }
        }

        return $items->last();
    }
}
