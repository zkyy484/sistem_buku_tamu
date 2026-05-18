<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Tamu;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Tamu::with([
            'tujuan',
            'pegawai'
        ])
        ->latest()
        ->get();

        return view('pimpinan.laporan.index',
            compact('laporan'));
    }
}