<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Tamu::with([
            'tujuan',
            'pegawai'
        ]);

        if ($request->tanggal_awal &&
            $request->tanggal_akhir) {

            $query->whereBetween('tanggal_konsultasi', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        if ($request->status) {

            $query->where('status', $request->status);
        }

        $laporan = $query->latest()->get();

        return view('admin.laporan.index', compact('laporan'));
    }

    public function exportPdf(Request $request)
    {
        $laporan = Tamu::with([
            'tujuan',
            'pegawai'
        ])->latest()->get();

        $pdf = Pdf::loadView(
            'admin.laporan.pdf',
            compact('laporan')
        );

        return $pdf->download('laporan-konsultasi.pdf');
    }
}