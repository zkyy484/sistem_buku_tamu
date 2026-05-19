<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubBagian extends Model
{
    protected $table = 'sub_bagian';

    protected $primaryKey = 'id_sub_bagian';

    protected $fillable = [
        'nama_sub_bagian',
        'deskripsi',
        'is_active'
    ];

    // relasi antar tabel
    public function pegawai()
    {
        return $this->hasMany(DataPegawai::class, 'id_sub_bagian');
    }
}
