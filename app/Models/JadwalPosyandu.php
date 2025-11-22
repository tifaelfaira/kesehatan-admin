<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    use HasFactory;

    protected $table = 'jadwal_posyandu';
    protected $primaryKey = 'jadwal_id';

    protected $fillable = [
        'nama_posyandu',
        'tanggal',
        'tema',
        'keterangan',
        'poster',
    ];

    // 🔗 RELASI: 1 Jadwal -> Banyak Layanan Posyandu
    public function layanan()
    {
        return $this->hasMany(LayananPosyandu::class, 'jadwal_id');
    }
}