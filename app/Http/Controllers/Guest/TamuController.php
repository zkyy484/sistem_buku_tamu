<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use App\Models\TujuanKonsultasi;
use Illuminate\Http\Request;

class TamuController extends Controller
{
    // fungsi untuk menapilkan halaman pengisian konsultasi pada tamu
    public function index()
    {
        $tujuan =
            TujuanKonsultasi::where(
                'is_active',
                1
            )->get();

        return view('guest.index', compact('tujuan'));
    }

    // fungsi untuk menampilkan halaman opening/awal pada tamu
    public function opening() {
        return view('guest.opening');
    }

    // fungsi untuk menambahkan data tamu/konsultasi pada tamu
    public function store(Request $request)
    {
        $request->validate([
            'pelaku_usaha' => 'required',
            'nik' => 'required',
            'nama_lengkap' => 'required',
            'nama_perusahaan_instansi' => 'required',
            'jabatan' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
            'id_tujuan' => 'required',
            'permasalahan' => 'required',
            'ttd_tamu' => 'required'
        ]);

        $kodeTiket = 'KNS-' . date('Ymd') . rand(1000, 9999);

        $tamu = Tamu::create([
            'kode_tiket' => $kodeTiket,
            'tanggal_konsultasi' => now(),
            'pelaku_usaha' => $request->pelaku_usaha,
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'nama_perusahaan_instansi' => $request->nama_perusahaan_instansi,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'id_tujuan' => $request->id_tujuan,
            'permasalahan' => $request->permasalahan,
            'ttd_tamu' => $request->ttd_tamu,
            'ttd_pegawai' => $request->ttd_pegawai,
            'status' => 'Belum Eskalasi'
        ]);

        return redirect('/buku-tamu')
            ->with(
                'success',
                'Konsultasi berhasil dikirim. Nomor Tiket: '
                . $kodeTiket
            );
    }
}