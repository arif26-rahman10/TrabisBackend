@extends('adminlte::page')

@section('title', 'Edit Data Jadwal')

@section('content_header')
    <h1>Edit Data Jadwal</h1>
@endsection

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jadwal.update', $jadwal->id_jadwal) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_supir">Sopir</label>
            <select name="id_supir" class="form-control" required>
                <option value="">-- Pilih Sopir --</option>
                @foreach($sopirs as $sopir)
                    <option value="{{ $sopir->id_supir }}" {{ $sopir->id_supir == $jadwal->id_supir ? 'selected' : '' }}>
                        {{ $sopir->name }} - {{ $sopir->mobil }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="lokasi_penjemputan">Lokasi Penjemputan</label>
            <input type="text" name="lokasi_penjemputan" class="form-control" value="{{ old('lokasi_penjemputan', $jadwal->lokasi_penjemputan) }}" required>
        </div>

        <div class="form-group">
            <label for="lokasi_tujuan">Lokasi Tujuan</label>
            <input type="text" name="lokasi_tujuan" class="form-control" value="{{ old('lokasi_tujuan', $jadwal->lokasi_tujuan) }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal_keberangkatan">Tanggal & Jam Keberangkatan</label>
            <input type="datetime-local" name="tanggal_keberangkatan" class="form-control"
                value="{{ old('tanggal_keberangkatan', \Carbon\Carbon::parse($jadwal->tanggal_keberangkatan)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="form-group">
            <label for="kursi">Jumlah Kursi</label>
            <input type="number" name="kursi" class="form-control" value="{{ old('kursi', $jadwal->kursi) }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="aktif" {{ $jadwal->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $jadwal->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
