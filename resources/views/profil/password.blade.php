{{-- resources/views/profil/password.blade.php --}}
@extends('adminlte::page')

@section('title', 'Ubah Password')

@section('content_header')
    <h1>Ubah Password</h1>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profil.password.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Password Lama</label>
            <input type="password" name="current_password" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password Baru</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Password</button>
        <a href="{{ route('profil.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection
