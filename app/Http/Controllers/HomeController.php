<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penumpang;
use App\Models\Sopir;
use App\Models\Jadwal;
use App\Models\Pemesanan;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'totalPenumpang' => Penumpang::count(),
            'totalSopir'     => Sopir::count(),
            'totalJadwal'    => Jadwal::count(),
            'totalPemesanan' => Pemesanan::count(),
        ]);
    }
}
