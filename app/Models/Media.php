<?php
// app/Models/Media.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order'
    ];

    // Scope untuk mengambil media berdasarkan tabel dan ID
    public function scopeForRef($query, $refTable, $refId)
    {
        return $query->where('ref_table', $refTable)
                     ->where('ref_id', $refId)
                     ->orderBy('sort_order', 'asc')
                     ->orderBy('created_at', 'asc');
    }

    // Helper untuk mendapatkan URL file
    public function getFileUrlAttribute()
    {
        return asset('storage/media/' . $this->file_name);
    }

    // Helper untuk mendapatkan path file
    public function getFilePathAttribute()
    {
        return storage_path('app/public/media/' . $this->file_name);
    }

    // Cek apakah file adalah gambar
    public function getIsImageAttribute()
    {
        return strpos($this->mime_type, 'image/') === 0;
    }

    // Cek apakah file adalah PDF
    public function getIsPdfAttribute()
    {
        return $this->mime_type === 'application/pdf';
    }
}
