<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $fillable = [
        'nama',
        'email', 
        'telepon',
        'alamat'
    ];

    // Relasi ke multipleuploads
    public function files()
    {
        return $this->hasMany(Multipleuploads::class, 'ref_id')->where('ref_table', 'pelanggan');
    }
}
