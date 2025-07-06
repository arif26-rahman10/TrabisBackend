<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penumpang extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model (opsional)
     * Jika nama tabel berbeda dengan konvensi Laravel
     */
    protected $table = 'penumpang';

    /**
     * Kolom yang bisa diisi (mass assignment)
     */
    protected $fillable = [
        'nama_penumpang',
        'alamat',
        'nomor_hp',
        'email',
        'tujuan'
    ];

    /**
     * Format khusus untuk kolom tertentu
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Validasi aturan untuk model
     */
    public static $rules = [
        'nama_penumpang' => 'required|string|max:100',
        'alamat' => 'required|string',
        'nomor_hp' => 'required|string|max:20',
        'email' => 'required|email|unique:penumpang,email',
        'tujuan' => 'required|string|max:50'
    ];
}