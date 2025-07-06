<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sopir extends Model
{
    use HasFactory;

    // ⬅️ Perhatikan di sini! harus 'sopir' bukan 'supir'
    protected $table = 'sopir';
    protected $primaryKey = 'id_supir';

    protected $fillable = [
        'name',
        'email',
        'no_hp',
        'biaya',
        'mobil',
        'plat_mobil',
        'gambarMobil',
    ];
}
