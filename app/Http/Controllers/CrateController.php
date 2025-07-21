<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\GachaHistory;

class CrateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $user = Auth::user();

        if ($user && $user->user_role === 'seller') {
            $crates = Crate::where('owner_id', $user->kode_user)->get();
            return view('crates.index', compact('crates'));
        }

        $crates = Crate::where('status', 'active')->get();
        $userKeys = [];

        if ($user) {
            $userKeys = DB::table('user_keys')
                ->select('key_id', 'jumlah')
                ->where('user_id', $user->user_id)
                ->where('jumlah', '>', 0)
                ->get()
                ->pluck('jumlah', 'key_id')
                ->toArray();
        }

        return view('crates.index', compact('crates', 'userKeys'));
    }

    public function showCrateByOwner()
    {
        $user = Auth::user();
        $crates = Crate::where('owner_id', $user->kode_user)
            ->where('deleted', 0)
            ->get();

        return view('product.productpage', compact('crates'));
    }

    public function show($id)
    {
        $crate = Crate::with('key')->findOrFail($id);
        if (Auth::user() && Auth::user()->user_role === 'seller' && Auth::user()->kode_user === $crate->owner_id) {
            return redirect()->route('crates.edit', $id);
        }
        return view('crates.show', compact('crate'));
    }

    public function updateStok(Request $request)
    {
        $stokData = $request->input('stok', []);

        foreach ($stokData as $crateId => $items) {
            $crate = Crate::find($crateId);
            if ($crate && $crate->owner_id === Auth::user()->kode_user) {
                foreach ($items as $field => $value) {
                    $crate->{$field . '_stok'} = max(0, (int)$value);
                }
                $crate->save();
            }
        }

        return redirect()->route('product')->with('success', 'Stok berhasil diperbarui.');
    }

    public function edit($id)
    {
        $crate = Crate::with('key')->findOrFail($id);
        return view('crates.edit', compact('crate'));
    }

    public function update(Request $request, $id)
    {
        $crate = Crate::findOrFail($id);

        $request->validate([
            'crate_name' => 'required|string',
            'key_name' => 'required|string',
            'key_price' => 'required|numeric',
        ]);

        if ($request->hasFile('crate_image')) {
            $crateImage = uniqid() . '.' . $request->file('crate_image')->getClientOriginalExtension();
            $request->file('crate_image')->move(public_path('images'), $crateImage);
            $crate->crate_image = $crateImage;
        }

        $crate->name = $request->crate_name;
        for ($i = 1; $i <= 5; $i++) {
            $crate->{'item'.$i.'_name'} = $request->input("item_name_$i");
            $crate->{'item'.$i.'_rate'} = $request->input("item_rate_$i");

            if ($request->hasFile("item_image_$i")) {
                $itemImage = uniqid() . '.' . $request->file("item_image_$i")->getClientOriginalExtension();
                $request->file("item_image_$i")->move(public_path('images'), $itemImage);
                $crate->{'item'.$i.'_image'} = $itemImage;
            }
        }
        $crate->save();

        $key = $crate->key;
        if ($key) {
            $key->nama_key = $request->key_name;
            $key->harga_key = $request->key_price;

            if ($request->hasFile('key_image')) {
                $keyImage = uniqid() . '.' . $request->file('key_image')->getClientOriginalExtension();
                $request->file('key_image')->move(public_path('images'), $keyImage);
                $key->image_key = $keyImage;
            }

            $key->save();
        }

        if ($request->has('status')) {
            $crate->status = $request->status;
            $crate->save();

            if ($crate->key) {
                $crate->key->status = $request->status;
                $crate->key->save();
            }
        }

        return redirect('/crates')->with('success', 'Crate dan Key berhasil diperbarui!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'crate_name' => 'required|string',
            'key_name' => 'required|string',
            'key_price' => 'required|numeric',
            'crate_image' => 'required|image|mimes:jpeg,jpg,png',
            'key_image' => 'required|image|mimes:jpeg,jpg,png',
            'item_image_1' => 'required|image|mimes:jpeg,jpg,png',
            'item_image_2' => 'required|image|mimes:jpeg,jpg,png',
            'item_image_3' => 'required|image|mimes:jpeg,jpg,png',
            'item_image_4' => 'required|image|mimes:jpeg,jpg,png',
            'item_image_5' => 'required|image|mimes:jpeg,jpg,png',
        ]);

        function saveImage($file) {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            return $filename;
        }

        $crateImage = saveImage($request->file('crate_image'));
        $keyImage = saveImage($request->file('key_image'));

        $itemImages = [];
        for ($i = 1; $i <= 5; $i++) {
            $itemImages[$i] = saveImage($request->file("item_image_$i"));
        }

        $userId = auth()->user()->kode_user;
        $existingKey = DB::table('shop_key')->where('nama_key', $request->key_name)->first();
        if ($existingKey) {
            return redirect()->back()->withInput()->with('error', '❌ Nama key sudah digunakan. Silakan pilih nama lain.');
        }

        DB::transaction(function () use ($request, $userId, $crateImage, $keyImage, $itemImages) {
            $crateId = DB::table('crates')->insertGetId([
                'name' => $request->crate_name,
                'crate_image' => $crateImage,
                'owner_id' => $userId,
                'item1_name' => $request->input('item_name_1'),
                'item1_image' => $itemImages[1],
                'item1_rate' => $request->input('item_rate_1'),
                'item2_name' => $request->input('item_name_2'),
                'item2_image' => $itemImages[2],
                'item2_rate' => $request->input('item_rate_2'),
                'item3_name' => $request->input('item_name_3'),
                'item3_image' => $itemImages[3],
                'item3_rate' => $request->input('item_rate_3'),
                'item4_name' => $request->input('item_name_4'),
                'item4_image' => $itemImages[4],
                'item4_rate' => $request->input('item_rate_4'),
                'item5_name' => $request->input('item_name_5'),
                'item5_image' => $itemImages[5],
                'item5_rate' => $request->input('item_rate_5'),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $keyId = DB::table('shop_key')->insertGetId([
                'nama_key' => $request->key_name,
                'harga_key' => $request->key_price,
                'image_key' => $keyImage,
                'delete_key' => 'N',
                'status' => 'active',
                'kode_user' => $userId,
                'crate_id' => $crateId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('crates')->where('id', $crateId)->update(['key_id' => $keyId]);
        });

        return redirect('/crates')->with('success', 'Crate dan Key berhasil disimpan!');
    }

    public function destroy($id)
    {
        $crate = Crate::with('key')->findOrFail($id);
        $crate->deleted = 1;
        $crate->save();

        if ($crate->key) {
            $crate->key->delete_key = 'Y';
            $crate->key->save();
        }

        return redirect('/crates')->with('success', 'Crate berhasil dinonaktifkan.');
    }

    public function openCrate($crate_id)
    {
        $user = Auth::user();
        $crate = Crate::findOrFail($crate_id);

        $items = [
            ['name' => $crate->item1_name, 'image' => $crate->item1_image, 'rate' => $crate->item1_rate],
            ['name' => $crate->item2_name, 'image' => $crate->item2_image, 'rate' => $crate->item2_rate],
            ['name' => $crate->item3_name, 'image' => $crate->item3_image, 'rate' => $crate->item3_rate],
            ['name' => $crate->item4_name, 'image' => $crate->item4_image, 'rate' => $crate->item4_rate],
            ['name' => $crate->item5_name, 'image' => $crate->item5_image, 'rate' => $crate->item5_rate],
        ];

        $picked = $this->randomItemByRate(collect($items));

        GachaHistory::create([
            'user_id' => $user->user_id,
            'crate_id' => $crate->id,
            'item_name' => $picked['name'],
            'item_image' => $picked['image'],
            'rate' => $picked['rate']
        ]);

        return view('gacha.result', compact('picked'));
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

    public function gachaHistory()
    {
        $user = Auth::user();
        $histories = GachaHistory::where('user_id', $user->user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('gacha.history', compact('histories'));
    }
}
