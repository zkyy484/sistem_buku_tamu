<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\KonsultasiSelesaiMail;
use App\Models\Tamu;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Mail;
use Storage;

class AdminKonsultasiController extends Controller
{

    // Fungsi untuk menampilkan halaman konsultasi tamu pada admin
    public function index(Request $request)
    {
        $query = Tamu::with('tujuan');

        if ($request->search) {

            $query->where('nama_lengkap', 'like', '%' . $request->search . '%')
                ->orWhere('kode_tiket', 'like', '%' . $request->search . '%');
        }

        $konsultasi = $query->latest()->get();

        return view('admin.konsultasi.index', compact('konsultasi'));
    }

    // Fungsi untuk menampilkan halaman detail konsultasi pada admin
    public function show($id)
    {
        $konsultasi = Tamu::with([
            'tujuan',
            'pegawai'
        ])->findOrFail($id);

        return view('admin.konsultasi.show', compact('konsultasi'));
    }

    // Fungsi untuk melakukan update data konsultasi pada admin
    public function update(Request $request, $id)
    {
        $request->validate([
            'solusi' => 'required',
            'status' => 'required',
            // 'ttd_pegawai' => 'required'
        ]);

        $konsultasi = Tamu::with('tujuan')->findOrFail($id);

        // jika kosong pakai TTD lama
        $ttdPegawai = $request->ttd_pegawai ?: $request->ttd_lama;

        // 1. Update data utama terlebih dahulu
        $konsultasi->update([
            'solusi' => $request->solusi,
            'status' => $request->status,
            'ttd_pegawai' => $ttdPegawai,
            'id_pegawai' => auth()->user()->id_pegawai
        ]);

        // reload data terbaru
        $konsultasi->refresh();

        // 2. CEK KONDISI: Jika email BELUM PERNAH dikirim (email_sent_at masih null)
        if (is_null($konsultasi->email_sent_at)) {

            // Generate PDF
            $pdf = Pdf::loadView('pdf.hasil_konsultasi', [
                'konsultasi' => $konsultasi
            ]);

            $namaFile = 'hasil_konsultasi_' . $konsultasi->kode_tiket . '.pdf';
            $path = 'pdf/' . $namaFile;

            \Storage::disk('public')->put($path, $pdf->output());

            $konsultasi->update([
                'pdf_path' => $path,
                'email_sent_at' => now()
            ]);

            // kirim email
            Mail::to($konsultasi->email)->send(
                new KonsultasiSelesaiMail($konsultasi, $path)
            );

            $pesanFlash = 'Konsultasi berhasil diproses & email terkirim.';
        } else {
            // Jika email sudah pernah dikirim sebelumnya, buat PDF baru agar isinya terupdate (Opsional)
            // Namun jika tidak ingin meng-update file PDF-nya sama sekali, bagian ini bisa dikosongkan.

            $pdf = Pdf::loadView('pdf.hasil_konsultasi', ['konsultasi' => $konsultasi]);
            $namaFile = 'hasil_konsultasi_' . $konsultasi->kode_tiket . '.pdf';
            $path = 'pdf/' . $namaFile;
            \Storage::disk('public')->put($path, $pdf->output());

            $konsultasi->update([
                'pdf_path' => $path
            ]);

            $pesanFlash = 'Data konsultasi berhasil diperbarui (Email tidak dikirim ulang).';
        }

        return redirect('/admin/konsultasi')->with('success', $pesanFlash);
    }

    // Fungsi untuk melakukan download pdf data konsultasi pada admin
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
