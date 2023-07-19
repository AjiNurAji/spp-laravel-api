<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_petugas',
        'nisn',
        'tgl_bayar',
        'bulan_dibayar',
        'tahun_dibayar',
        'id_spp',
        'jumlah_bayar'
    ];

    public function petugas()
    {
        return $this->hasMany('id_petugas', Users::class);
    }

    public function siswa()
    {
        return $this->hasMany('nisn', Siswa::class);
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class,  'id_spp');
    }
}
