<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username',
        'email',
        'password',
        'id_role_akses',
        'id_pegawai',
        'is_active',
        'last_login'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(RoleAkses::class, 'id_role_akses');
    }

    public function pegawai()
    {
        return $this->belongsTo(DataPegawai::class, 'id_pegawai');
    }

    public function isAdmin()
    {
        return $this->role->nama_role == 'admin';
    }

    public function isPegawai()
    {
        return $this->role->nama_role == 'pegawai';
    }

    public function isPimpinan()
    {
        return $this->role->nama_role == 'pimpinan';
    }
}
