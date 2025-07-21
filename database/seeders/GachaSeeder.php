<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GachaSeeder extends Seeder
{
    public function run()
    {
        DB::table('gacha')->insert([
            // Common items
            [
                'id_gacha' => 'GAC001',
                'nama_item' => 'Steam Wallet $1',
                'rarity' => 'Common',
                'chance_rate' => 40,
                'harga_item' => 15000,
                'stok_item' => 1000
            ],
            [
                'id_gacha' => 'GAC002',
                'nama_item' => 'CS:GO Common Skin',
                'rarity' => 'Common',
                'chance_rate' => 35,
                'harga_item' => 20000,
                'stok_item' => 800
            ],
            // Uncommon items
            [
                'id_gacha' => 'GAC003',
                'nama_item' => 'Steam Wallet $5',
                'rarity' => 'Uncommon',
                'chance_rate' => 15,
                'harga_item' => 75000,
                'stok_item' => 300
            ],
            [
                'id_gacha' => 'GAC004',
                'nama_item' => 'Random Game Key (Low Tier)',
                'rarity' => 'Uncommon',
                'chance_rate' => 12,
                'harga_item' => 100000,
                'stok_item' => 250
            ],
            // Rare items
            [
                'id_gacha' => 'GAC005',
                'nama_item' => 'Steam Wallet $10',
                'rarity' => 'Rare',
                'chance_rate' => 6,
                'harga_item' => 150000,
                'stok_item' => 100
            ],
            [
                'id_gacha' => 'GAC006',
                'nama_item' => 'CS:GO Rare Skin',
                'rarity' => 'Rare',
                'chance_rate' => 5,
                'harga_item' => 250000,
                'stok_item' => 80
            ],
            // Epic items
            [
                'id_gacha' => 'GAC007',
                'nama_item' => 'Steam Wallet $20',
                'rarity' => 'Epic',
                'chance_rate' => 2,
                'harga_item' => 300000,
                'stok_item' => 50
            ],
            [
                'id_gacha' => 'GAC008',
                'nama_item' => 'Random AAA Game Key',
                'rarity' => 'Epic',
                'chance_rate' => 2,
                'harga_item' => 400000,
                'stok_item' => 40
            ],
            // Legendary items
            [
                'id_gacha' => 'GAC009',
                'nama_item' => 'Steam Wallet $50',
                'rarity' => 'Legendary',
                'chance_rate' => 0.8,
                'harga_item' => 750000,
                'stok_item' => 20
            ],
            [
                'id_gacha' => 'GAC010',
                'nama_item' => 'CS:GO Knife Skin',
                'rarity' => 'Legendary',
                'chance_rate' => 0.2,
                'harga_item' => 1500000,
                'stok_item' => 5
            ]
        ]);
    }
}