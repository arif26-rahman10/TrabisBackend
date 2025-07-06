@extends('adminlte::page')

@section('title', 'Data Penumpang')

@section('content_header')
    <h1>Daftar Penumpang</h1>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('penumpang.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Penumpang</th>
                        <th>Alamat</th>
                        <th>Nomor HP</th>
                        <th>Email</th>
                        <th>Tujuan</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penumpangs as $key => $penumpang)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $penumpang->nama_penumpang }}</td>
                            <td>{{ $penumpang->alamat }}</td>
                            <td>{{ $penumpang->nomor_hp }}</td>
                            <td>{{ $penumpang->email }}</td>
                            <td>{{ $penumpang->tujuan }}</td>
                            <td class="d-flex justify-content-between">
                                <a href="{{ route('penumpang.show', $penumpang->id) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('penumpang.edit', $penumpang->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('penumpang.destroy', $penumpang->id) }}" method="POST" onsubmit="return confirm('Hapus data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
