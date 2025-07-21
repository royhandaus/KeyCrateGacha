<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('key')->insert([
            [
                'kode_id' => 'KEY0001',
                'nama_key' => 'Dust Crate',
                'jenis_key' => 'Rare',
                'harga_key' => 50000,
            ],
            [
                'kode_id' => 'KEY0002',
                'nama_key' => 'Ironfang Cache',
                'jenis_key' => 'Elite',
                'harga_key' => 100000,
            ],
            [
                'kode_id' => 'KEY0003',
                'nama_key' => 'Nebula Vault',
                'jenis_key' => 'Epic',
                'harga_key' => 100000,
            ],
            [
                'kode_id' => 'KEY0004',
                'nama_key' => 'Oracle Box',
                'jenis_key' => 'Fate',
                'harga_key' => 200000,
            ],
            [
                'kode_id' => 'KEY0005',
                'nama_key' => 'Eclipse Chest',
                'jenis_key' => 'Mythic',
                'harga_key' => 700000,
            ],
            [
                'kode_id' => 'KEY0006',
                'nama_key' => 'Celestia Relic',
                'jenis_key' => 'Divine',
                'harga_key' => 1000000,
            ],
        ]);
    }
}
