<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    public function run()
    {
        DB::table('invoices')->insert([
            [
                'invoice_code' => 'INV001',
                'user_id' => 1,
                'total_price' => 225000,
                'status' => 'paid',
                'created_at' => now()->subDays(5)
            ],
            [
                'invoice_code' => 'INV002',
                'user_id' => 3,
                'total_price' => 600000,
                'status' => 'paid',
                'created_at' => now()->subDays(3)
            ],
            [
                'invoice_code' => 'INV003',
                'user_id' => 5,
                'total_price' => 150000,
                'status' => 'paid',
                'created_at' => now()->subDays(2)
            ],
            [
                'invoice_code' => 'INV004',
                'user_id' => 7,
                'total_price' => 300000,
                'status' => 'paid',
                'created_at' => now()->subDay()
            ],
            [
                'invoice_code' => 'INV005',
                'user_id' => 8,
                'total_price' => 75000,
                'status' => 'unpaid',
                'created_at' => now()
            ],
            [
                'invoice_code' => 'INV006',
                'user_id' => 10,
                'total_price' => 100000,
                'status' => 'paid',
                'created_at' => now()->subHours(2)
            ],
            [
                'invoice_code' => 'INV007',
                'user_id' => 1,
                'total_price' => 250000,
                'status' => 'paid',
                'created_at' => now()->subDays(10)
            ],
            [
                'invoice_code' => 'INV008',
                'user_id' => 3,
                'total_price' => 100000,
                'status' => 'paid',
                'created_at' => now()->subDays(7)
            ],
            [
                'invoice_code' => 'INV009',
                'user_id' => 5,
                'total_price' => 80000,
                'status' => 'paid',
                'created_at' => now()->subDays(4)
            ],
            [
                'invoice_code' => 'INV010',
                'user_id' => 7,
                'total_price' => 500000,
                'status' => 'cancelled',
                'created_at' => now()->subDays(1)
            ]
        ]);
    }
}