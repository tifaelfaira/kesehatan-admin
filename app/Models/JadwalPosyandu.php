<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; // TAMBAH INI

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