<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    // Relasi ke JadwalPosyandu
    public function jadwal()
    {
        return $this->belongsTo(JadwalPosyandu::class, 'jadwal_id', 'jadwal_id');
    }

    // Relasi ke Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'id');
    }

    // Scope untuk filter
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    // TAMBAH INI: Scope untuk search
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
        return $query;
    }
}