<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Posyandu extends Model
{
    protected $table = 'posyandu';
    protected $primaryKey = 'posyandu_id';
    protected $fillable = ['nama', 'alamat', 'rt', 'rw', 'kontak', 'foto']; // TAMBAH 'foto'

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
    }

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