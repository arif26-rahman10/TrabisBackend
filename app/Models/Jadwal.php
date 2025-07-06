<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_supir',
        'lokasi_penjemputan',
        'lokasi_tujuan',
        'tanggal_keberangkatan',
        'kursi',
        'status',
    ];

    // Relasi ke tabel sopir
    public function sopir()
    {
        return $this->belongsTo(Sopir::class, 'id_supir', 'id_supir');
    }
}
