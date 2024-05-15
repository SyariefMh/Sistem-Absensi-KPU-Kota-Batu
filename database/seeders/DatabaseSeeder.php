<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\periode;
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
                'name' => 'Satpam Kasus',
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
                'name' => 'Satpam',
                'role' => 'adminSatpam',
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

        $periodes = [
            [
                'periode_bulan' => 'Januari',
                'periode_tahun' => '2024',
                'nama_jabatan' => 'Rudi Gumilar',
                'nip_nama_jabatan' => '123456789',
                'status' => 1, // Misalnya status aktif
            ],
            [
                'periode_bulan' => 'Februari',
                'periode_tahun' => '2024',
                'nama_jabatan' => 'Rudi Gumilar',
                'nip_nama_jabatan' => '123456789',
                'status' => 0, // Misalnya status tidak aktif
            ],
            // Tambahkan data periode lainnya sesuai kebutuhan
        ];
        foreach ($periodes as $key => $periode) {
            periode::create($periode);
        }
    }
}
