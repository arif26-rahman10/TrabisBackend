<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Sopir;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('sopir')->orderBy('created_at', 'desc')->get();
        return view('jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $sopirs = \App\Models\Sopir::all();
        return view('jadwal.create', compact('sopirs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_supir' => 'required|exists:sopir,id_supir',
            'lokasi_penjemputan' => 'required|string|max:255',
            'lokasi_tujuan' => 'required|string|max:255',
            'tanggal_keberangkatan' => 'required|date',
            'kursi' => 'required|integer|min:1',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function show($id)
    {
        $jadwal = Jadwal::with('sopir')->findOrFail($id);
        return view('jadwal.show', compact('jadwal'));
    }

    public function edit($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $sopirs = Sopir::all();
        return view('jadwal.edit', compact('jadwal', 'sopirs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_supir' => 'required|exists:sopir,id_supir',
            'lokasi_penjemputan' => 'required|string|max:255',
            'lokasi_tujuan' => 'required|string|max:255',
            'tanggal_keberangkatan' => 'required|date',
            'kursi' => 'required|integer|min:1',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
