@extends('adminlte::page')

@section('title', 'Tambah Penumpang')

@section('content_header')
    <h1>Tambah Data Penumpang</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('penumpang.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Penumpang</label>
                    <input type="text" name="nama_penumpang" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label>Nomor HP</label>
                    <input type="text" name="nomor_hp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tujuan</label>
                    <input type="text" name="tujuan" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('penumpang.index') }}" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
@endsection