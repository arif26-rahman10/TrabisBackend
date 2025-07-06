@extends('adminlte::page')

@section('title', 'Edit Data Penumpang')

@section('content_header')
    <h1>Edit Data Penumpang</h1>
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

    <form action="{{ route('penumpang.update', $penumpang->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_penumpang">Nama Penumpang</label>
            <input type="text" name="nama_penumpang" class="form-control" value="{{ old('nama_penumpang', $penumpang->nama_penumpang) }}" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $penumpang->alamat) }}" required>
        </div>

        <div class="form-group">
            <label for="nomor_hp">Nomor HP</label>
            <input type="text" name="nomor_hp" class="form-control" value="{{ old('nomor_hp', $penumpang->nomor_hp) }}" required placeholder="Contoh: 08123456789">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $penumpang->email) }}" required>
        </div>

        <div class="form-group">
            <label for="tujuan">Tujuan</label>
            <input type="text" name="tujuan" class="form-control" value="{{ old('tujuan', $penumpang->tujuan) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('penumpang.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
