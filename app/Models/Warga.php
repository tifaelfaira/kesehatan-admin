<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga'; // Pastikan ini ada

    protected $fillable = [
        'nama',
        'nik',
        'jenis_kelamin',
        'umur',
        'pekerjaan',
        'alamat',
        'rt_rw',
    ];
}
