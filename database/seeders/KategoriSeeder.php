<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        DB::table('kategori')->insert([
            [
                'kode_kategori' => 'KAT001',
                'jenis_kategori' => 'box',
                'deskripsi' => 'box untuk digacha'
            ],
            [
                'kode_kategori' => 'KAT002',
                'jenis_kategori' => 'Key',
                'deskripsi' => 'Kunci game Steam, Epic Games, Origin, dll'
            ]
        ]);
    }
}