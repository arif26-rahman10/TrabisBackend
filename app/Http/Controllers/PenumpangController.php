<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penumpang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PenumpangController extends Controller
{
    /**
     * Menampilkan daftar penumpang dengan pagination dan pencarian
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $penumpangs = Penumpang::when($search, function ($query) use ($search) {
                return $query->where('nama_penumpang', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('nomor_hp', 'like', "%$search%");
            })
            ->latest()
            ->paginate(10);

        return view('penumpang.index', compact('penumpangs', 'search'));
    }

    /**
     * Menampilkan form tambah penumpang
     */
    public function create()
    {
        return view('penumpang.create');
    }

    /**
     * Menyimpan data penumpang baru (LENGKAP dengan validasi, format nomor HP, dan error handling)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_penumpang' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'nomor_hp' => ['required', 'string', 'max:20', 'regex:/^(\+62|0)[0-9]+$/'],
            'email' => 'required|email|unique:penumpang,email',
            'tujuan' => 'required|string|max:50',
        ], [
            'nama_penumpang.required' => 'Nama penumpang wajib diisi!',
            'nomor_hp.regex' => 'Nomor HP hanya boleh berisi angka.',
            'email.unique' => 'Email sudah digunakan oleh penumpang lain.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Format nomor HP (contoh: 081234 → +6281234)
            $nomor_hp = $this->formatNomorHP($request->nomor_hp);

            // Simpan data ke database
            $penumpang = Penumpang::create([
                'nama_penumpang' => $request->nama_penumpang,
                'alamat' => $request->alamat,
                'nomor_hp' => $nomor_hp,
                'email' => Str::lower($request->email),
                'tujuan' => $request->tujuan,
            ]);

            return redirect()
                ->route('penumpang.index')
                ->with([
                    'success' => 'Data penumpang berhasil ditambahkan!',
                    'highlight' => $penumpang->id, // Untuk scroll ke data baru
                ]);

        } catch (\Exception $e) {
            Log::error('Gagal menyimpan penumpang: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data. Silakan coba lagi.');
        }
    }

    /**
     * Menampilkan detail penumpang
     */
    public function show($id)
    {
        $penumpang = Penumpang::findOrFail($id);
        return view('penumpang.show', compact('penumpang'));
    }

    /**
     * Menampilkan form edit penumpang
     */
    public function edit($id)
{
    $penumpang = Penumpang::findOrFail($id);
    return view('penumpang.edit', compact('penumpang'));
}

    /**
     * Mengupdate data penumpang (LENGKAP dengan validasi dan handling error)
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_penumpang' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'nomor_hp' => ['required', 'string', 'max:20', 'regex:/^(\+62|0)[0-9]+$/'],
            'email' => 'required|email|unique:penumpang,email,' . $id,
            'tujuan' => 'required|string|max:50',
        ], [
            'email.unique' => 'Email sudah digunakan oleh penumpang lain.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $penumpang = Penumpang::findOrFail($id);
            $penumpang->update([
                'nama_penumpang' => $request->nama_penumpang,
                'alamat' => $request->alamat,
                'nomor_hp' => $this->formatNomorHP($request->nomor_hp),
                'email' => Str::lower($request->email),
                'tujuan' => $request->tujuan,
            ]);

            return redirect()
                ->route('penumpang.index')
                ->with('success', 'Data penumpang berhasil diperbarui!');

        } catch (\Exception $e) {
            Log::error('Gagal update penumpang: ' . $e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data. Silakan coba lagi.');
        }
    }

    /**
     * Menghapus data penumpang
     */
    public function destroy($id)
    {
        try {
            Penumpang::destroy($id);
            return redirect()
                ->route('penumpang.index')
                ->with('success', 'Data penumpang berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Gagal hapus penumpang: ' . $e->getMessage());
            return back()
                ->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }

    /**
     * Helper untuk format nomor HP (+62)
     */
    private function formatNomorHP($nomor)
{
    $nomor = preg_replace('/[^0-9]/', '', $nomor); // ambil hanya angka
    if (Str::startsWith($nomor, '0')) {
        return '+62' . substr($nomor, 1);
    }
    return '+62' . $nomor; // fallback kalau user langsung input 812xxxxx
}
}