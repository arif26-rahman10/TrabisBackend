<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Penumpang;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::with(['penumpang', 'jadwal'])->orderBy('created_at', 'desc')->get();
        return view('pemesanan.index', compact('pemesanans'));
    }

    public function create()
    {
        $penumpangs = Penumpang::all();
        $jadwals = Jadwal::with('sopir')->get(); // pastikan relasi 'sopir' tersedia
        return view('pemesanan.create', compact('penumpangs', 'jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penumpang' => 'required|exists:penumpang,id',
            'id_jadwal' => 'required|exists:jadwal,id_jadwal',
            'jumlah_kursi' => 'required|integer|min:1',
            'lokasi_penjemputan' => 'required|string|max:255',
            'lokasi_tujuan' => 'required|string|max:255',
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $jadwal = Jadwal::with('sopir')->findOrFail($request->id_jadwal);
        $biaya = $jadwal->sopir->biaya ?? 0;
        $total = $request->jumlah_kursi * $biaya;

        Pemesanan::create([
            'id_penumpang' => $request->id_penumpang,
            'id_jadwal' => $request->id_jadwal,
            'jumlah_kursi' => $request->jumlah_kursi,
            'total_harga' => $total,
            'lokasi_penjemputan' => $request->lokasi_penjemputan,
            'lokasi_tujuan' => $request->lokasi_tujuan,
            'status' => $request->status
        ]);

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::with(['penumpang', 'jadwal'])->findOrFail($id);
        return view('pemesanan.show', compact('pemesanan'));
    }

    public function edit($id)
    {
        $pemesanan = Pemesanan::with('jadwal.sopir')->findOrFail($id);
        $penumpangs = Penumpang::all();
        $jadwals = Jadwal::with('sopir')->get();
        return view('pemesanan.edit', compact('pemesanan', 'penumpangs', 'jadwals'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_jadwal' => 'required|exists:jadwal,id_jadwal',
            'jumlah_kursi' => 'required|integer|min:1',
            'lokasi_penjemputan' => 'required|string|max:255',
            'lokasi_tujuan' => 'required|string|max:255',
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);
        $jadwal = Jadwal::with('sopir')->findOrFail($request->id_jadwal);
        $biaya = $jadwal->sopir->biaya ?? 0;
        $total = $request->jumlah_kursi * $biaya;

        $pemesanan->update([
            'id_jadwal' => $request->id_jadwal,
            'jumlah_kursi' => $request->jumlah_kursi,
            'total_harga' => $total,
            'lokasi_penjemputan' => $request->lokasi_penjemputan,
            'lokasi_tujuan' => $request->lokasi_tujuan,
            'status' => $request->status
        ]);

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Pemesanan::findOrFail($id)->delete();
        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dihapus.');
    }
}
