@extends('adminlte::page')

@section('title', 'Detail Pemesanan')

@section('content_header')
    <h1>Detail Pemesanan</h1>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <strong>Informasi Pemesanan</strong>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 200px;">Nama Penumpang</th>
                    <td>{{ $pemesanan->penumpang->nama_penumpang ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jadwal</th>
                    <td>
                        {{ $pemesanan->jadwal->lokasi_penjemputan }} → {{ $pemesanan->jadwal->lokasi_tujuan }}
                        <br>
                        <small class="text-muted">
                            {{ \Carbon\Carbon::parse($pemesanan->jadwal->tanggal_keberangkatan)->format('d-m-Y H:i') }}
                        </small>
                    </td>
                </tr>
                <tr>
                    <th>Jumlah Kursi</th>
                    <td>{{ $pemesanan->jumlah_kursi }}</td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td>Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Lokasi Penjemputan</th>
                    <td>{{ $pemesanan->lokasi_penjemputan }}</td>
                </tr>
                <tr>
                    <th>Lokasi Tujuan</th>
                    <td>{{ $pemesanan->lokasi_tujuan }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @php
                            $statusBadge = [
                                'pending' => ['label' => 'Menunggu', 'class' => 'badge badge-secondary'],
                                'paid' => ['label' => 'Dibayar', 'class' => 'badge badge-success'],
                                'cancelled' => ['label' => 'Dibatalkan', 'class' => 'badge badge-danger'],
                            ];
                            $status = $statusBadge[$pemesanan->status] ?? ['label' => ucfirst($pemesanan->status), 'class' => 'badge badge-light'];
                        @endphp
                        <span class="{{ $status['class'] }}">{{ $status['label'] }}</span>
                    </td>
                </tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@endsection