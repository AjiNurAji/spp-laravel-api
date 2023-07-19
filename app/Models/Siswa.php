<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Siswa extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'siswa';

    protected $primaryKey = 'nisn';

    protected $fillable = [
        'nisn',
        'nis',
        'nama',
        'id_kelas',
        'alamat',
        'no_telp',
        'id_spp',
        'level'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class, 'id_spp');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
