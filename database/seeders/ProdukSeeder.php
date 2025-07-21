<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        DB::table('produk')->insert([
            // Steam Wallet products
            [
                'kode_produk' => 'PROD001',
                'nama_produk' => 'Paket data kecil 1GB',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [
                'kode_produk' => 'PROD002',
                'nama_produk' => 'Token listrik kecil Rp10.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD003',
                'nama_produk' => 'Steam wallet  Rp10.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => 'MW0WO-8Z607-UI3F6',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD004',
                'nama_produk' => 'E-Wallet voucher Rp10.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD005',
                'nama_produk' => 'Pulsa kecil Rp5.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [
                'kode_produk' => 'PROD006',
                'nama_produk' => 'Paket data 2GB',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [
                'kode_produk' => 'PROD007',
                'nama_produk' => 'Token listrik sedang Rp20.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD008',
                'nama_produk' => 'Steam wallet  Rp30.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => 'MW0WO-8Z607-UI3F6',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD009',
                'nama_produk' => 'E-Wallet voucher Rp20.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD010',
                'nama_produk' => 'Pulsa sedang Rp10.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [
                'kode_produk' => 'PROD011',
                'nama_produk' => 'Paket data 3GB',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [
                'kode_produk' => 'PROD012',
                'nama_produk' => 'Token listrik Rp25.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD013',
                'nama_produk' => 'Steam wallet  Rp50.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => 'MW0WO-8Z607-UI3F6',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD014',
                'nama_produk' => 'E-Wallet voucher Rp30.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD015',
                'nama_produk' => 'Pulsa sedang Rp20.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [
                'kode_produk' => 'PROD016',
                'nama_produk' => 'Paket data 4GB',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD017',
                'nama_produk' => 'Steam wallet  Rp100.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => 'MW0WO-8Z607-UI3F6',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD018',
                'nama_produk' => 'E-Wallet voucher Rp50.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [
                'kode_produk' => 'PROD019',
                'nama_produk' => 'Paket data besar 10GB',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [
                'kode_produk' => 'PROD020',
                'nama_produk' => 'Token listrik Rp100.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD021',
                'nama_produk' => 'Steam wallet  Rp200.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => 'MW0WO-8Z607-UI3F6',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD022',
                'nama_produk' => 'Steam wallet  Rp300.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => 'MW0WO-8Z607-UI3F6',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD023',
                'nama_produk' => 'Pulsa besar Rp50.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
             [
                'kode_produk' => 'PROD024',
                'nama_produk' => 'Paket data premium unlimited',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [
                'kode_produk' => 'PROD025',
                'nama_produk' => 'Token listrik premium Rp150.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD026',
                'nama_produk' => 'Steam wallet Rp500.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => 'MW0WO-8Z607-UI3F6',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD027',
                'nama_produk' => 'E-wallet voucher Rp750.000 ',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            [ 
                'kode_produk' => 'PROD028',
                'nama_produk' => 'Pulsa besar Rp100.000',
                'stok_produk' => 9999,
                'kode_redeem_produk' => '',
                'rating' => 5,
                'available_produk' => 1
            ],
            

        ]);
    }
}