<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanImunisasi extends Model
{
    use HasFactory;

    protected $table = 'catatan_imunisasi';
    protected $primaryKey = 'imunisasi_id';

    protected $fillable = [
        'warga_id',
        'jenis_vaksin',
        'tanggal',
        'lokasi',
        'nakes',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Scope untuk filter
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                if ($column === 'tanggal_dari') {
                    $query->whereDate('tanggal', '>=', $request->input($column));
                } elseif ($column === 'tanggal_sampai') {
                    $query->whereDate('tanggal', '<=', $request->input($column));
                } elseif ($column === 'nama_warga') {
                    $query->whereHas('warga', function($q) use ($request) {
                        $q->where('nama', 'like', '%' . $request->input('nama_warga') . '%');
                    });
                } else {
                    $query->where($column, 'like', '%' . $request->input($column) . '%');
                }
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
                    if ($column === 'nama_warga') {
                        $q->orWhereHas('warga', function($q2) use ($request) {
                            $q2->where('nama', 'LIKE', '%' . $request->search . '%');
                        });
                    } else {
                        $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                    }
                }
            });
        }
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'id');
    }
}