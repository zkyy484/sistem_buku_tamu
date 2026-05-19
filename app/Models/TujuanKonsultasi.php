<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TujuanKonsultasi extends Model
{
    protected $table = 'tujuan_konsultasi';

    protected $primaryKey = 'id_tujuan';

    protected $fillable = [
        'tujuan_konsultasi',
        'is_active'
    ];

    // relasi antar tabel
    public function tamu()
    {
        return $this->hasMany(Tamu::class, 'id_tujuan');
    }
}
