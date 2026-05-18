<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // return view('pegawai.dashboard');

        $pegawaiId = auth()->user()->id_pegawai;

        // total data ditangani pegawai login
        $totalDitangani = Tamu::where(
            'id_pegawai',
            $pegawaiId
        )->count();


        // total per status
        $baru = Tamu::where(
            'id_pegawai',
            $pegawaiId
        )
            ->where('status', 'Baru')
            ->count();

        $diproses = Tamu::where(
            'id_pegawai',
            $pegawaiId
        )
            ->where('status', 'Diproses')
            ->count();

        $selesai = Tamu::where(
            'id_pegawai',
            $pegawaiId
        )
            ->where('status', 'Selesai')
            ->count();


        // grafik sub bagian
        $subBagian = Tamu::join(
            'data_pegawai',
            'tamu.id_pegawai',
            '=',
            'data_pegawai.id_pegawai'
        )
            ->join(
                'sub_bagian',
                'data_pegawai.id_sub_bagian',
                '=',
                'sub_bagian.id_sub_bagian'
            )
            ->select(
                'sub_bagian.nama_sub_bagian',
                DB::raw('count(*) as total')
            )
            ->groupBy(
                'sub_bagian.nama_sub_bagian'
            )
            ->get();

        $belumDitangani = Tamu::whereNull(
            'id_pegawai'
        )->count();

        return view(
            'pegawai.dashboard',
            compact(
                'totalDitangani',
                'baru',
                'diproses',
                'selesai',
                'subBagian',
                'belumDitangani'
            )
        );
    }
}
