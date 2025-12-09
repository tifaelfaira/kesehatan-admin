<?php
// app/Models/Posyandu.php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    protected $table = 'posyandu';
    protected $primaryKey = 'posyandu_id';

    // HAPUS 'foto' dari fillable
    protected $fillable = ['nama', 'alamat', 'rt', 'rw', 'kontak'];

    // Relasi ke media
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'posyandu_id')
                    ->where('ref_table', 'posyandu')
                    ->orderBy('sort_order', 'asc')
                    ->orderBy('created_at', 'asc');
    }

    // Helper untuk mendapatkan foto utama
    public function getFotoAttribute()
    {
        return $this->media->first();
    }

    // Scope untuk filter
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, 'like', '%' . $request->input($column) . '%');
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

    // Relasi ke jadwal
    public function jadwal()
    {
        return $this->hasMany(JadwalPosyandu::class, 'posyandu_id', 'posyandu_id');
    }
}
