@extends('adminlte::page')

@section('title', 'Detail Jadwal')

@section('content_header')
    <h1>Detail Jadwal</h1>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <strong>Informasi Jadwal</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th style="width: 200px;">Sopir</th>
                        <td>{{ $jadwal->sopir->name ?? 'Tidak Diketahui' }}</td>
                    </tr>
                    <tr>
                        <th>Lokasi Penjemputan</th>
                        <td>{{ $jadwal->lokasi_penjemputan }}</td>
                    </tr>
                    <tr>
                        <th>Lokasi Tujuan</th>
                        <td>{{ $jadwal->lokasi_tujuan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Keberangkatan</th>
                        <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_keberangkatan)->format('d M Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Kursi</th>
                        <td>{{ $jadwal->kursi }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($jadwal->status === 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="mt-4 text-end">
                    <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
