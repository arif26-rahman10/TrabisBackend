@extends('adminlte::page')

@section('title', 'Profil Pengguna')

@section('content_header')
    <h1>Profil Admin</h1>
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center mb-3">
                    <img class="profile-user-img img-fluid img-circle"
                         src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"
                         alt="Foto Profil" style="width: 120px; height: 120px;">
                </div>

                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                <p class="text-muted text-center">Administrator</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item"><b>Nama</b> <span class="float-right">{{ $user->name }}</span></li>
                    <li class="list-group-item"><b>Email</b> <span class="float-right">{{ $user->email }}</span></li>
                </ul>

                <a href="{{ route('profil.edit') }}" class="btn btn-primary btn-block"><b>Edit Profil</b></a>
                <a href="{{ route('profil.password') }}" class="btn btn-secondary btn-block"><b>Ubah Password</b></a>
            </div>
        </div>
    </div>
</div>
@endsection
