@extends('adminlte::page')

@section('title', 'Tambah Jadwal')

@section('content_header')
    <h1>Tambah Data Jadwal</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('jadwal.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Supir</label>
                    <select name="id_supir" class="form-control" required>
                        <option value="">-- Pilih Sopir --</option>
                        @foreach($sopirs as $sopir)
                            <option value="{{ $sopir->id_supir }}">{{ $sopir->name }} - {{ $sopir->mobil }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <label>Lokasi Penjemputan</label>
                    <input type="text" name="lokasi_penjemputan" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Lokasi Tujuan</label>
                    <input type="text" name="lokasi_tujuan" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Tanggal Keberangkatan</label>
                    <input type="datetime-local" name="tanggal_keberangkatan" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Jumlah Kursi</label>
                    <input type="number" name="kursi" class="form-control" required min="1">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('jadwal.index') }}" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
@endsection