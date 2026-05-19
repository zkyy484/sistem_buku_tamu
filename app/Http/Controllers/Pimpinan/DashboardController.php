<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\SubBagian;
use App\Models\Tamu;
use App\Models\TujuanKonsultasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // fungsi untuk menampilkan halaman dashboard pada pimpinan
    public function index()
    {
        // 1. Akumulasi Tamu berdasarkan Tujuan Konsultasi
        $tujuanChart = TujuanKonsultasi::withCount('tamu')->get();

        // 2. Akumulasi Tamu berdasarkan Sub Bagian (Pegawai)
        $subBagianChart = SubBagian::withCount([
            'pegawai as total_tamu' => function ($query) {
                $query->join('tamu', 'data_pegawai.id_pegawai', '=', 'tamu.id_pegawai');
            }
        ])->get();

        // 3. Akumulasi Persentase BERDASARKAN STATUS TAMU
        // Query ini menghitung total tamu per status yang ada di database
        $statusChart = Tamu::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        // 4. Counter Tambahan Info Box
        $totalTamu = Tamu::count();
        $tamuSelesai = Tamu::where('status', 'Selesai')->count(); // Disesuaikan dengan status selesai
        $tamuPending = Tamu::whereIn('status', ['Belum Eskalasi'])->count();

        // Tambahkan baris ini di DashboardController Anda
        $tamuTerbaru = Tamu::with(['tujuan', 'pegawai'])
            ->latest()
            ->take(5)
            ->get();

        return view('pimpinan.dashboard', compact(
            'tujuanChart',
            'subBagianChart',
            'statusChart',
            'totalTamu',
            'tamuSelesai',
            'tamuPending',
            'tamuTerbaru'
        ));
    }
}
