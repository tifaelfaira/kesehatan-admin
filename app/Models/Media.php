<?php

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
        'sort_order',
    ];

    public function getFileUrlAttribute(): string
    {
        return asset('storage/media/' . $this->file_name);
    }

    public function getFilePathAttribute(): string
    {
        return storage_path('app/public/media/' . $this->file_name);
    }

    public function getIsImageAttribute(): bool
    {
        return str_starts_with($this->mime_type, 'image/');
    }
}
