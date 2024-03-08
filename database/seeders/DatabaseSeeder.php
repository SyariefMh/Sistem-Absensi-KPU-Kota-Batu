<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Maulana',
                'role' => 'pegawai',
                'password' => bcrypt('123456'),
                'jabatan' => 'PNS',
                'nip' => '12345678',
            ],
            [
                'name' => 'PPNPN',
                'role' => 'pegawai',
                'password' => bcrypt('123456'),
                'jabatan' => 'PPNPN'
            ],
            [
                'name' => 'Satpam',
                'role' => 'pegawai',
                'password' => bcrypt('123456'),
                'jabatan' => 'Satpam'
            ],
            [
                'name' => 'Admin',
                'role' => 'admin',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Kasubag Umum',
                'role' => 'kasubag umum',
                'password' => bcrypt('123456')
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
