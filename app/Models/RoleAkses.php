<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleAkses extends Model
{
    protected $table = 'role_akses';

    protected $primaryKey = 'id_role_akses';

    protected $fillable = [
        'nama_role',
        'deskripsi'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_role_akses');
    }
}
