<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKesehatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nama_kegiatan',
        'keterangan',
        'lokasi',
    ];
}
