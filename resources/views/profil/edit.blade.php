@extends('adminlte::page')

@section('title', 'Edit Profil')

@section('content_header')
    <h1>Edit Profil</h1>
@endsection

@section('content')
<form action="{{ route('profil.update') }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('profil.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
