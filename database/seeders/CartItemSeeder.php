<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartItemSeeder extends Seeder
{
    public function run()
    {
        DB::table('cart_item')->insert([
            // Aditya's cart
            [
                'cart_id' => 1,
                'produk_id' => 2, // Steam Wallet $10
                'quantity' => 1,
                'harga_satuan' => 150000
            ],
            [
                'cart_id' => 1,
                'produk_id' => 10, // Premium Gacha Key
                'quantity' => 1,
                'harga_satuan' => 75000
            ],
            // Budi's cart
            [
                'cart_id' => 2,
                'produk_id' => 3, // Elden Ring
                'quantity' => 1,
                'harga_satuan' => 600000
            ],
            // Annisa's cart
            [
                'cart_id' => 3,
                'produk_id' => 2, // Steam Wallet $10
                'quantity' => 1,
                'harga_satuan' => 150000
            ],
            // Dewi's cart
            [
                'cart_id' => 4,
                'produk_id' => 2, // Steam Wallet $10
                'quantity' => 2,
                'harga_satuan' => 150000
            ],
            // Andi's cart
            [
                'cart_id' => 8,
                'produk_id' => 1, // Steam Wallet $5
                'quantity' => 1,
                'harga_satuan' => 75000
            ],
            // Rian's cart
            [
                'cart_id' => 10,
                'produk_id' => 10, // Premium Gacha Key
                'quantity' => 1,
                'harga_satuan' => 100000
            ]
        ]);
    }
}