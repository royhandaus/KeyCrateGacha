<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('boxes')->insert([
            [
                'kode_box' => 'BOX0001',
                'jenis' => 'Rare',
                'nama_box' => 'Dust Crate',
                
                
            ],
            [
                'kode_box' => 'BOX0002',
                'jenis' => 'Elite',
                'nama_box' => 'Ironfang Cache',
                
                
            ],
            [
                'kode_box' => 'BOX0003',
                'jenis' => 'Epic',
                'nama_box' => 'Nebula Vault',
                
                
            ],
            [
                'kode_box' => 'BOX0004',
                'jenis' => 'Fate',
                'nama_box' => 'Oracle Box',
                
                
            ],
            [
                'kode_box' => 'BOX0005',
                'jenis' => 'Mythic',
                'nama_box' => 'Eclipse Chest',
                
                
            ],
            [
                'kode_box' => 'BOX0006',
                'jenis' => 'Divine',
                'nama_box' => 'Celestia Relic',
                
                
            ],
        ]);
    }
}
