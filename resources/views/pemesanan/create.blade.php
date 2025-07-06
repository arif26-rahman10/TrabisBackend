@extends('adminlte::page')

@section('title', 'Tambah Pemesanan')

@section('content_header')
    <h1>Tambah Pemesanan</h1>
@endsection

@section('content')
    <form action="{{ route('pemesanan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Penumpang</label>
            <select name="id_penumpang" class="form-control" required>
                <option value="">Pilih Penumpang</option>
                @foreach($penumpangs as $penumpang)
                    <option value="{{ $penumpang->id }}">{{ $penumpang->nama_penumpang }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Jadwal</label>
            <select name="id_jadwal" class="form-control" required>
                <option value="">Pilih Jadwal</option>
                @foreach($jadwals as $jadwal)
                    <option value="{{ $jadwal->id_jadwal }}">
                        {{ $jadwal->lokasi_penjemputan }} → {{ $jadwal->lokasi_tujuan }} ({{ \Carbon\Carbon::parse($jadwal->tanggal_keberangkatan)->format('d-m-Y H:i') }}) - Biaya: Rp{{ number_format($jadwal->sopir->biaya ?? 0, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Jumlah Kursi</label>
            <input type="number" name="jumlah_kursi" class="form-control" required>
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
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="pending">Menunggu</option>
                <option value="paid">Dibayar</option>
                <option value="cancelled">Dibatalkan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
