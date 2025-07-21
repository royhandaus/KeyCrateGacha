<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cart')->insert([
            [
                'kode_cart' => 'CRT0001',
                'user_id' => 1,
                'harga_total' => 20000,
            ],
            [
                'kode_cart' => 'CRT0002',
                'user_id' => 2,
                'harga_total' => 50000,
            ],
            [
                'kode_cart' => 'CRT0003',
                'user_id' => 3,
                'harga_total' => 30000,
            ],
            [
                'kode_cart' => 'CRT0004',
                'user_id' => 4,
                'harga_total' => 150000,
            ],
            [
                'kode_cart' => 'CRT0005',
                'user_id' => 5,
                'harga_total' => 45000,
            ],
            [
                'kode_cart' => 'CRT0006',
                'user_id' => 6,
                'harga_total' => 70000,
            ],
            [
                'kode_cart' => 'CRT0007',
                'user_id' => 7,
                'harga_total' => 60000,
            ],
            [
                'kode_cart' => 'CRT0008',
                'user_id' => 8,
                'harga_total' => 90000,
            ],
            [
                'kode_cart' => 'CRT0009',
                'user_id' => 9,
                'harga_total' => 120000,
            ],
            [
                'kode_cart' => 'CRT0010',
                'user_id' => 10,
                'harga_total' => 80000,
            ],
        ]);
    }
}