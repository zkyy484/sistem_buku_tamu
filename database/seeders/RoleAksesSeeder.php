<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleAksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    // fungsi untuk menambahkan data role akses pada tabel role_akses
    public function run(): void
    {
        DB::table('role_akses')->insert([
            [
                'nama_role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_role' => 'pegawai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_role' => 'pimpinan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
