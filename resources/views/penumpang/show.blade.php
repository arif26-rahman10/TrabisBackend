@extends('adminlte::page')

@section('title', 'Detail Penumpang')

@section('content_header')
    <h1>Detail Penumpang</h1>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <strong>Informasi Penumpang</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th style="width: 200px;">Nama Penumpang</th>
                        <td>{{ $penumpang->nama_penumpang }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $penumpang->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Nomor HP</th>
                        <td>{{ $penumpang->nomor_hp }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $penumpang->email }}</td>
                    </tr>
                    <tr>
                        <th>Tujuan</th>
                        <td>{{ $penumpang->tujuan }}</td>
                    </tr>
                </table>

                <div class="mt-4 text-end">
                    <a href="{{ route('penumpang.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
