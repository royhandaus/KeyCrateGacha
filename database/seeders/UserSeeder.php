<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        
        DB::table('users')->insert([
            [
                'kode_user' => 'USR0001',
                'nama_user' => 'Aditya Nugraha',
                'user_username' => 'Aditya123',
                'user_email' => 'aditya@example.com',
                'user_password' => Hash::make('password123'),
                'user_role' => 'user',
                'no_telp' => '81234567890',
            ],
            [
                'kode_user' => 'USR0002',
                'nama_user' => 'Siti Rahmawati',
                'user_username' => 'sit123',
                'user_email' => 'siti@example.com',
                'user_password' => Hash::make('password123'),
                'user_role' => 'seller',
                'no_telp' => '81398765432',
            ],
            [
                'kode_user' => 'USR0003',
                'nama_user' => 'Budi Santoso',
                'user_username' => 'bud123',
                'user_email' => 'budi@example.com',
                'user_password' =>Hash::make('password123'),
                'user_role' => 'user',
                'no_telp' => '81412345678',
            ],
            [
                'kode_user' => 'USR0004',
                'nama_user' => 'Rizky Pratama',
                'user_username' => 'riz123',
                'user_email' => 'rizky@example.com',
                'user_password' => Hash::make('password123'),
                'user_role' => 'seller',
                'no_telp' => '81587654321',
            ],
            [
                'kode_user' => 'USR0005',
                'nama_user' => 'Annisa Putri',
                'user_username' => 'Ann123',
                'user_email' => 'annisa@example.com',
                'user_password' =>Hash::make('password123'),
                'user_role' => 'user',
                'no_telp' => '81634567890',
            ],
            [
                'kode_user' => 'USR0006',
                'nama_user' => 'Fahmi Rahman',
                'user_username' => 'fah123',
                'user_email' => 'fahmi@example.com',
                'user_password' => Hash::make('password123'),
                'user_role' => 'seller',
                'no_telp' => '81765432109',
            ],
            [
                'kode_user' => 'USR0007',
                'nama_user' => 'Dewi Lestari',
                'user_username' => 'dew123',
                'user_email' => 'dewi@example.com',
                'user_password' => Hash::make('password123'),
                'user_role' => 'user',
                'no_telp' => '81876543210',
            ],
            [
                'kode_user' => 'USR0008',
                'nama_user' => 'Andi Wijaya',
                'user_username' => 'and123',
                'user_email' => 'andi@example.com',
                'user_password' =>Hash::make('password123'),
                'user_role' => 'user',
                'no_telp' => '81987654321',
            ],
            [
                'kode_user' => 'USR0009',
                'nama_user' => 'Nabila Sari',
                'user_email' => 'nabila@example.com',
                'user_username' => 'nab123',
                'user_password' => Hash::make('password123'),
                'user_role' => 'seller',
                'no_telp' => '82098765432',
            ],
            [
                'kode_user' => 'USR0010',
                'nama_user' => 'Rian Firmansyah',
                'user_username' => 'ria123',
                'user_email' => 'rian@example.com',
                'user_password' =>Hash::make('password123'),
                'user_role' => 'user',
                'no_telp' => '82109876543',
            ],
        ]);
    }
}
