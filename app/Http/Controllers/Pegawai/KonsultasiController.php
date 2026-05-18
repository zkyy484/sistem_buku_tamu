<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\KonsultasiSelesaiMail;
use Illuminate\Support\Facades\Storage;

class KonsultasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Tamu::with('tujuan');

        if ($request->search) {

            $query->where('nama_lengkap', 'like', '%' . $request->search . '%')
                ->orWhere('kode_tiket', 'like', '%' . $request->search . '%');
        }

        $konsultasi = $query->latest()->get();

        return view('pegawai.konsultasi.index', compact('konsultasi'));
    }

    public function show($id)
    {
        $konsultasi = Tamu::with([
            'tujuan',
            'pegawai'
        ])->findOrFail($id);

        return view('pegawai.konsultasi.show', compact('konsultasi'));
    }

    // public function update(Request $request, $id)
    // {
    //     // dd($request->ttd_pegawai);

    //     $request->validate([
    //         'solusi' => 'required',
    //         'status' => 'required',
    //         'ttd_pegawai'=>'required'
    //     ]);

    //     $konsultasi = Tamu::with('tujuan')
    //         ->findOrFail($id);

    //     $konsultasi->update([
    //         'solusi' => $request->solusi,
    //         'status' => $request->status,
    //         'ttd_pegawai'=>$request->ttd_pegawai,
    //         'id_pegawai' => auth()->user()->id_pegawai
    //     ]);

    //     if ($request->status == 'Selesai') {

    //         $pdf = Pdf::loadView('pdf.hasil_konsultasi', [
    //             'konsultasi' => $konsultasi
    //         ]);

    //         $namaFile = 'hasil_konsultasi_' .
    //             $konsultasi->kode_tiket . '.pdf';

    //         $path = 'pdf/' . $namaFile;

    //         \Storage::disk('public')
    //             ->put($path, $pdf->output());

    //         $konsultasi->update([
    //             'pdf_path' => $path,
    //             'email_sent_at' => now()
    //         ]);

    //         Mail::to($konsultasi->email)
    //             ->send(new KonsultasiSelesaiMail(
    //                 $konsultasi,
    //                 $path
    //             ));
    //     }

    //     return redirect('/pegawai/konsultasi')
    //         ->with(
    //             'success',
    //             'Konsultasi berhasil diproses'
    //         );
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'solusi' => 'required',
            'status' => 'required',
            // 'ttd_pegawai' => 'required'
        ]);

        $konsultasi = Tamu::with('tujuan')
            ->findOrFail($id);

        $ttdPegawai = $request->ttd_pegawai;

        // jika kosong pakai TTD lama
        $ttdPegawai =
            $request->ttd_pegawai
            ?: $request->ttd_lama;

        $konsultasi->update([

            'solusi' => $request->solusi,

            'status' => $request->status,

            'ttd_pegawai' => $ttdPegawai,

            'id_pegawai' => auth()->user()->id_pegawai

        ]);

        // $konsultasi->update([
        //     'solusi' => $request->solusi,
        //     'status' => $request->status,
        //     'ttd_pegawai' => $request->ttd_pegawai,
        //     'id_pegawai' => auth()->user()->id_pegawai
        // ]);

        // reload data terbaru
        $konsultasi->refresh();


        // Generate PDF
        $pdf = Pdf::loadView(
            'pdf.hasil_konsultasi',
            [
                'konsultasi' => $konsultasi
            ]
        );

        $namaFile =
            'hasil_konsultasi_' .
            $konsultasi->kode_tiket .
            '.pdf';

        $path = 'pdf/' . $namaFile;

        \Storage::disk('public')
            ->put(
                $path,
                $pdf->output()
            );

        $konsultasi->update([
            'pdf_path' => $path,
            'email_sent_at' => now()
        ]);

        // kirim email
        Mail::to(
            $konsultasi->email
        )->send(
                new KonsultasiSelesaiMail(
                    $konsultasi,
                    $path
                )
            );

        return redirect('/pegawai/konsultasi')
            ->with(
                'success',
                'Konsultasi berhasil diproses & email terkirim'
            );
    }

    public function downloadPdf($id)
    {
        $konsultasi = Tamu::findOrFail($id);

        if (!$konsultasi->pdf_path) {

            return back()->with(
                'error',
                'PDF belum tersedia'
            );
        }

        return Storage::disk('public')
            ->download(
                $konsultasi->pdf_path,
                'hasil-konsultasi-' . $konsultasi->kode_tiket . '.pdf'
            );
    }
}