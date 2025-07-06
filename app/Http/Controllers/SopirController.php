<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Sopir;

class SopirController extends Controller
{
    public function index()
    {
        $sopirs = Sopir::orderBy('created_at', 'desc')->get();
        return view('sopir.index', compact('sopirs'));
    }

    public function create()
    {
        return view('sopir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:sopir,email',
            'no_hp' => 'required',
            'biaya' => 'required',
            'mobil' => 'required',
            'plat_mobil' => 'required',
            'gambarMobil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // upload gambar jika ada
        if ($request->hasFile('gambarMobil')) {
            $image = $request->file('gambarMobil');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['gambarMobil'] = 'images/' . $imageName;
        }

        Sopir::create($data);

        return redirect()->route('sopir.index')->with('success', 'Data sopir berhasil ditambahkan.');
    }

    public function show($id)
    {
        $sopir = Sopir::findOrFail($id);
        return view('sopir.show', compact('sopir'));
    }

    public function edit($id)
    {
        $sopir = Sopir::findOrFail($id);
        return view('sopir.edit', compact('sopir'));
        if ($request->hasFile('gambarMobil')) {
            $file = $request->file('gambarMobil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['gambarMobil'] = $filename;
        }
    }

    public function update(Request $request, $id)
    {
        $sopir = Sopir::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:sopir,email,' . $sopir->id_supir . ',id_supir',
            'no_hp' => 'required',
            'biaya' => 'required',
            'mobil' => 'required',
            'plat_mobil' => 'required',
            'gambarMobil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // upload gambar baru jika ada
        if ($request->hasFile('gambarMobil')) {
            // hapus gambar lama jika ada
            if ($sopir->gambarMobil && file_exists(public_path($sopir->gambarMobil))) {
                unlink(public_path($sopir->gambarMobil));
            }

            $image = $request->file('gambarMobil');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['gambarMobil'] = 'images/' . $imageName;
        }

        $sopir->update($data);

        return redirect()->route('sopir.index')->with('success', 'Data sopir berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $sopir = Sopir::findOrFail($id);

        // hapus gambar jika ada
        if ($sopir->gambarMobil && file_exists(public_path($sopir->gambarMobil))) {
            unlink(public_path($sopir->gambarMobil));
        }

        $sopir->delete();

        return redirect()->route('sopir.index')->with('success', 'Data sopir berhasil dihapus.');
    }
}