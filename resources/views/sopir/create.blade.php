@extends('adminlte::page')

@section('title', 'Tambah Sopir')

@section('content_header')
    <h1>Tambah Data Sopir</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('sopir.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Nomor Hp</label>
                    <input type="text" name="no_hp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Biaya</label>
                    <input type="text" name="biaya" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Mobil</label>
                    <input type="text" name="mobil" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Plat Mobil</label>
                    <input type="text" name="plat_mobil" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Gambar Mobil</label>
                    <input type="file" name="gambarMobil" class="form-control-file" accept="image/*" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('sopir.index') }}" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
@endsection
