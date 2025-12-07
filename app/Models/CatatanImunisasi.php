<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanImunisasi extends Model
{
    use HasFactory;

    protected $table = 'catatan_imunisasi';
    protected $primaryKey = 'imunisasi_id';

    protected $fillable = [
        'warga_id',
        'jenis_vaksin',  // PERBAIKAN: ganti jadi jenis_vaksin
        'tanggal',
        'lokasi',
        'nakes',
        
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'id');
    }
}