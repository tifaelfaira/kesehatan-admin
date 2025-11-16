<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananPosyandu extends Model
{
    // Nama tabel
    protected $table = 'layanan_posyandu';

    // Primary key sesuai migration
    protected $primaryKey = 'layanan_id';

    // Primary key auto increment
    public $incrementing = true;

    // Tipe primary key integer
    protected $keyType = 'int';

    // Kolom yang bisa diisi
    protected $fillable = [
        'jadwal_id',
        'warga_id',
        'berat',
        'tinggi',
        'vitamin',
        'konseling',
    ];

    // Relasi ke JadwalKesehatan
    public function jadwal()
    {
        return $this->belongsTo(JadwalKesehatan::class, 'jadwal_id', 'id');
    }

    // Relasi ke Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'id');
    }
}
