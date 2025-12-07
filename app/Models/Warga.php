<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';

    protected $fillable = [
        'nama',
        'nik',
        'jenis_kelamin',
        'umur',
        'pekerjaan',
        'alamat',
        'rt_rw',
    ];

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

    // ========== TAMBAHAN UNTUK RELASI DENGAN CATATAN IMUNISASI ==========
    
    /**
     * Relasi ke tabel catatan_imunisasi (satu warga bisa punya banyak catatan imunisasi)
     */
    public function catatanImunisasi()
    {
        return $this->hasMany(CatatanImunisasi::class, 'warga_id');
    }

    /**
     * Accessor untuk menampilkan nama lengkap dengan NIK (format dropdown)
     */
    public function getNamaLengkapAttribute()
    {
        return $this->nama . ' (NIK: ' . $this->nik . ')';
    }

    /**
     * Scope untuk mengambil data warga dalam format dropdown
     */
    public function scopeForDropdown($query)
    {
        return $query->select('id', 'nama', 'nik')->orderBy('nama');
    }

    /**
     * Method untuk mendapatkan data warga dalam format array untuk select2
     */
    public function toArrayForSelect()
    {
        return [
            'id' => $this->id,
            'text' => $this->nama . ' (NIK: ' . $this->nik . ')'
        ];
    }
}