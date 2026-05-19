<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPegawai extends Model
{
    protected $table = 'data_pegawai';

    protected $primaryKey = 'id_pegawai';

    protected $fillable = [
        'nama_pegawai',
        'nip',
        'email',
        'jabatan',
        'id_sub_bagian',
        'no_hp',
        'alamat',
        'is_active'
    ];

    // relasi antar tabel
    public function subBagian()
    {
        return $this->belongsTo(SubBagian::class, 'id_sub_bagian');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id_pegawai');
    }

    public function tamu()
    {
        return $this->hasMany(Tamu::class, 'id_pegawai');
    }
}
