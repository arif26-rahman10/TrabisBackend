@extends('adminlte::page')

@section('title', 'Data Jadwal')

@section('content_header')
    <h1>Daftar Jadwal</h1>
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
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Supir</th>
                        <th>Lokasi Penjemputan</th>
                        <th>Lokasi Tujuan</th>
                        <th>Tanggal Keberangkatan</th>
                        <th>Kursi</th>
                        <th>Status</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwals as $key => $jadwal)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $jadwal->sopir->name ?? '-' }}</td>
                            <td>{{ $jadwal->lokasi_penjemputan }}</td>
                            <td>{{ $jadwal->lokasi_tujuan }}</td>
                            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_keberangkatan)->format('d-m-Y H:i') }}</td>
                            <td>{{ $jadwal->kursi }}</td>
                            <td>
                                <span class="badge {{ $jadwal->status == 'aktif' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($jadwal->status) }}
                                </span>
                            </td>
                            <td class="d-flex justify-content-between">
                                <a href="{{ route('jadwal.show', $jadwal->id_jadwal) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('jadwal.edit', $jadwal->id_jadwal) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('jadwal.destroy', $jadwal->id_jadwal) }}" method="POST" onsubmit="return confirm('Hapus data jadwal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($jadwals->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data jadwal.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
