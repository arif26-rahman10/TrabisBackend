@extends('adminlte::page')

@section('title', 'Edit Data Sopir')

@section('content_header')
    <h1>Edit Data Sopir</h1>
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

    <form action="{{ route('sopir.update', $sopir->id_supir) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Sopir</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $sopir->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $sopir->email) }}" required>
        </div>

        <div class="form-group">
            <label for="no_hp">Nomor HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $sopir->no_hp) }}" required>
        </div>

        <div class="form-group">
            <label for="biaya">Biaya</label>
            <input type="number" name="biaya" class="form-control" value="{{ old('biaya', $sopir->biaya) }}" required>
        </div>

        <div class="form-group">
            <label for="mobil">Mobil</label>
            <input type="text" name="mobil" class="form-control" value="{{ old('mobil', $sopir->mobil) }}" required>
        </div>

        <div class="form-group">
            <label for="plat_mobil">Plat Mobil</label>
            <input type="text" name="plat_mobil" class="form-control" value="{{ old('plat_mobil', $sopir->plat_mobil) }}" required>
        </div>

        <div class="form-group">
            <label for="gambarMobil">Gambar Mobil</label><br>
            @if($sopir->gambarMobil)
                <img src="{{ asset('images/' . $sopir->gambarMobil) }}" alt="gambar" width="100" class="mb-2"><br>
            @endif
            <input type="file" name="gambarMobil" class="form-control-file">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('sopir.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
