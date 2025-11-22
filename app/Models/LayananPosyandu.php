<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; // TAMBAH INI

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

    // Relasi ke JadwalPosyandu (Ganti model)
    public function jadwal()
    {
        return $this->belongsTo(JadwalPosyandu::class, 'jadwal_id', 'jadwal_id');
    }

    // Relasi ke Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'id');
    }

    // TAMBAH INI: Scope untuk filter
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }
}