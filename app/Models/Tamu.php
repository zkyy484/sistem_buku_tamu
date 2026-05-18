<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    protected $table = 'tamu';

    protected $primaryKey = 'id_tamu';

    protected $fillable = [
        'kode_tiket',
        'tanggal_konsultasi',
        'pelaku_usaha',
        'nik',
        'nama_lengkap',
        'nama_perusahaan_instansi',
        'jabatan',
        'email',
        'no_hp',
        'id_tujuan',
        'permasalahan',
        'solusi',
        'id_pegawai',
        'status',
        'pdf_path',
        'ttd_tamu',
        'ttd_pegawai',
        'email_sent_at'
    ];

    public function tujuan()
    {
        return $this->belongsTo(TujuanKonsultasi::class, 'id_tujuan');
    }

    public function pegawai()
    {
        return $this->belongsTo(DataPegawai::class, 'id_pegawai');
    }
}
