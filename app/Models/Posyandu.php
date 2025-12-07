<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    protected $table = 'posyandu';
    protected $primaryKey = 'posyandu_id';
    protected $fillable = ['nama', 'alamat', 'rt', 'rw', 'kontak'];

    // Relasi ke kader (jika ada)
    public function kader()
    {
        return $this->hasMany(KaderPosyandu::class, 'posyandu_id', 'posyandu_id');
    }

    // Relasi ke jadwal
    public function jadwal()
    {
        return $this->hasMany(JadwalPosyandu::class, 'posyandu_id', 'posyandu_id');
    }
}