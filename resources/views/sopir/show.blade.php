@extends('adminlte::page')

@section('title', 'Detail Sopir')

@section('content_header')
    <h1>Detail Sopir</h1>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white fw-bold">
                Informasi Sopir
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    {{-- Kolom Gambar --}}
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        @if ($sopir->gambarMobil && file_exists(public_path($sopir->gambarMobil)))
                            <img src="{{ asset($sopir->gambarMobil) }}" alt="Gambar Mobil"
                                 class="img-fluid rounded shadow-sm" style="max-height: 240px;">
                            <p class="text-muted mt-2">Gambar Mobil</p>
                        @else
                            <img src="https://via.placeholder.com/300x200?text=Gambar+Tidak+Tersedia"
                                 class="img-fluid rounded shadow-sm" alt="Tidak Ada Gambar">
                            <p class="text-muted mt-2">Gambar Tidak Tersedia</p>
                        @endif
                    </div>

                    {{-- Kolom Informasi --}}
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 180px;">Nama</th>
                                <td>{{ $sopir->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $sopir->email }}</td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                                <td>{{ $sopir->no_hp }}</td>
                            </tr>
                            <tr>
                                <th>Biaya</th>
                                <td>Rp{{ number_format($sopir->biaya, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Mobil</th>
                                <td>{{ $sopir->mobil }}</td>
                            </tr>
                            <tr>
                                <th>Plat Mobil</th>
                                <td>{{ $sopir->plat_mobil }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- Tombol Kembali --}}
                <div class="mt-4 text-end">
                    <a href="{{ route('sopir.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
