<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tamu;
use App\Models\User;
use App\Models\SubBagian;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Akumulasi data tipe pelaku usaha / jenis instansi dari tabel tamu
        $totalPelakuUsaha = Tamu::where('pelaku_usaha', 'Pelaku Usaha')->count();
        $totalInstansiPemerintah = Tamu::where('pelaku_usaha', 'Instansi Pemerintah')->count();

        // 2. Total Konsultan / Tamu berdasarkan status operasionalnya
        $totalTamu = Tamu::count();
        $totalTamuSelesai = Tamu::where('status', 'Selesai')->count();
        $totalTamuProses = Tamu::where('status', 'Diproses')->count();

        // 3. Jumlah akun berdasarkan Role Akses Pegawai dan Pimpinan dari tabel users
        // Query ini mencantolkan (join) tabel role_akses untuk memfilter berdasarkan string nama_role ('pegawai' / 'pimpinan')
        $totalPegawai = User::whereNotNull('id_pegawai')
            ->whereHas('role', function ($query) {
                $query->where('nama_role', 'pegawai');
            })->count();

        $totalPimpinan = User::whereNotNull('id_pegawai')
            ->whereHas('role', function ($query) {
                $query->where('nama_role', 'pimpinan');
            })->count();

        // 4. Query Grafik: Menghitung jumlah tamu yang sukses dilayani per Sub Bagian
        // Alur Relasi: sub_bagian -> data_pegawai -> tamu
        $grafikData = SubBagian::select('sub_bagian.nama_sub_bagian')
            ->selectRaw('COUNT(tamu.id_tamu) as total_tamu')
            ->leftJoin('data_pegawai', 'sub_bagian.id_sub_bagian', '=', 'data_pegawai.id_sub_bagian')
            ->leftJoin('tamu', 'data_pegawai.id_pegawai', '=', 'tamu.id_pegawai')
            ->groupBy('sub_bagian.id_sub_bagian', 'sub_bagian.nama_sub_bagian')
            ->get();

        return view('admin.dashboard', compact(
            'totalPelakuUsaha',
            'totalInstansiPemerintah',
            'totalTamu',
            'totalTamuSelesai',
            'totalTamuProses',
            'totalPegawai',
            'totalPimpinan',
            'grafikData'
        ));
    }
}