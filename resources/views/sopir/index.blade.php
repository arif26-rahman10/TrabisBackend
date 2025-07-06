@extends('adminlte::page')

@section('title', 'Data Sopir')

@section('content_header')
    <h1>Daftar Sopir</h1>
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
            <a href="{{ route('sopir.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Biaya</th>
                        <th>Mobil</th>
                        <th>Plat Mobil</th>
                        <th>Gambar</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sopirs as $key => $sopir)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $sopir->name }}</td>
                            <td>{{ $sopir->email }}</td>
                            <td>{{ $sopir->no_hp }}</td>
                            <td>Rp{{ number_format($sopir->biaya, 0, ',', '.') }}</td>
                            <td>{{ $sopir->mobil }}</td>
                            <td>{{ $sopir->plat_mobil }}</td>
                            <td>
                                @if($sopir->gambarMobil)
                                <img src="{{ asset($sopir->gambarMobil) }}" alt="gambar" width="80">
                                @else
                                    Tidak ada
                                @endif
                            </td>
                            <td class="d-flex justify-content-between">
                                <a href="{{ route('sopir.show', $sopir->id_supir) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('sopir.edit', $sopir->id_supir) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('sopir.destroy', $sopir->id_supir) }}" method="POST" onsubmit="return confirm('Hapus data sopir ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($sopirs->isEmpty())
                        <tr>
                            <td colspan="9" class="text-center text-muted">Belum ada data sopir.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
