@extends('adminlte::page')

@section('title', 'Edit Pemesanan')

@section('content_header')
    <h1>Edit Pemesanan</h1>
@endsection

@section('content')
    <form action="{{ route('pemesanan.update', $pemesanan->id_pemesanan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_penumpang">Penumpang</label>
            <select name="id_penumpang" id="id_penumpang" class="form-control" required>
                <option value="">Pilih Penumpang</option>
                @foreach($penumpangs as $penumpang)
                    <option value="{{ $penumpang->id }}" {{ $pemesanan->id_penumpang == $penumpang->id ? 'selected' : '' }}>
                        {{ $penumpang->nama_penumpang }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="id_jadwal">Jadwal</label>
            <select name="id_jadwal" id="id_jadwal" class="form-control" required>
                <option value="">Pilih Jadwal</option>
                @foreach($jadwals as $jadwal)
                    <option value="{{ $jadwal->id_jadwal }}" {{ $pemesanan->id_jadwal == $jadwal->id_jadwal ? 'selected' : '' }}>
                        {{ $jadwal->lokasi_penjemputan }} → {{ $jadwal->lokasi_tujuan }} ({{ $jadwal->tanggal_keberangkatan }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="jumlah_kursi">Jumlah Kursi</label>
            <input type="number" name="jumlah_kursi" id="jumlah_kursi" value="{{ $pemesanan->jumlah_kursi }}" class="form-control" required min="1">
        </div>

        <div class="form-group">
            <label>Total Harga</label>
            <input type="text" class="form-control" value="Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}" readonly>
        </div>

        <div class="form-group">
            <label for="lokasi_penjemputan">Lokasi Penjemputan</label>
            <input type="text" name="lokasi_penjemputan" id="lokasi_penjemputan" value="{{ $pemesanan->lokasi_penjemputan }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="lokasi_tujuan">Lokasi Tujuan</label>
            <input type="text" name="lokasi_tujuan" id="lokasi_tujuan" value="{{ $pemesanan->lokasi_tujuan }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ $pemesanan->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                <option value="paid" {{ $pemesanan->status == 'paid' ? 'selected' : '' }}>Dibayar</option>
                <option value="cancelled" {{ $pemesanan->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
        <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </form>
@endsection
