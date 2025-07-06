<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';

    protected $fillable = [
        'id_penumpang',
        'id_jadwal',
        'jumlah_kursi',
        'total_harga',
        'lokasi_penjemputan',
        'lokasi_tujuan',
        'status',
    ];

    public function penumpang()
    {
        return $this->belongsTo(Penumpang::class, 'id_penumpang');
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal');
    }
}
