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
    public function run(): void
    {
        DB::table('role_akses')->insert([
            [
                'nama_role' => 'admin',
                'deskripsi' => 'Administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_role' => 'pegawai',
                'deskripsi' => 'Pegawai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_role' => 'pimpinan',
                'deskripsi' => 'Pimpinan',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
