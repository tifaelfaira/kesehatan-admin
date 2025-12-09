<?php
// app/Models/JadwalPosyandu.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class JadwalPosyandu extends Model
{
    use HasFactory;

    protected $table = 'jadwal_posyandu';
    protected $primaryKey = 'jadwal_id';

    // HAPUS 'poster' dari fillable
    protected $fillable = [
        'nama_posyandu',
        'tanggal',
        'tema',
        'keterangan'
    ];

    // Relasi ke media
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'jadwal_id')
                    ->where('ref_table', 'jadwal_posyandu')
                    ->orderBy('sort_order', 'asc')
                    ->orderBy('created_at', 'asc');
    }

    // Helper untuk mendapatkan poster utama
    public function getPosterAttribute()
    {
        return $this->media->first();
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

    // Scope untuk search
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
