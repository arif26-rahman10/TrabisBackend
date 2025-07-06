@extends('adminlte::page')

@section('title', 'Data Pemesanan')

@section('content_header')
    <h1>Daftar Pemesanan</h1>
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
            <a href="{{ route('pemesanan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Penumpang</th>
                        <th>Jadwal</th>
                        <th>Jumlah Kursi</th>
                        <th>Total Harga</th>
                        <th>Penjemputan</th>
                        <th>Tujuan</th>
                        <th>Status</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemesanans as $key => $pemesanan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $pemesanan->penumpang->nama_penumpang ?? '-' }}</td>
                            <td>
                                {{ $pemesanan->jadwal->lokasi_penjemputan ?? '-' }} - {{ $pemesanan->jadwal->lokasi_tujuan ?? '-' }}<br>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($pemesanan->jadwal->tanggal_keberangkatan)->format('d-m-Y H:i') }}
                                </small>
                            </td>
                            <td>{{ $pemesanan->jumlah_kursi }}</td>
                            <td>Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $pemesanan->lokasi_penjemputan }}</td>
                            <td>{{ $pemesanan->lokasi_tujuan }}</td>
                            <td>
                                @php
                                    $statusMap = [
                                        'pending' => ['label' => 'Menunggu', 'class' => 'bg-secondary'],
                                        'paid' => ['label' => 'Dibayar', 'class' => 'bg-success'],
                                        'cancelled' => ['label' => 'Dibatalkan', 'class' => 'bg-danger'],
                                    ];
                                    $status = $statusMap[$pemesanan->status] ?? ['label' => $pemesanan->status, 'class' => 'bg-light'];
                                @endphp
                                <span class="badge {{ $status['class'] }}">
                                    {{ $status['label'] }}
                                </span>
                            </td>
                            <td class="d-flex justify-content-between">
                                <a href="{{ route('pemesanan.show', $pemesanan->id_pemesanan) }}" class="btn btn-sm btn-info" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('pemesanan.edit', $pemesanan->id_pemesanan) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pemesanan.destroy', $pemesanan->id_pemesanan) }}" method="POST" onsubmit="return confirm('Hapus data pemesanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($pemesanans->isEmpty())
                        <tr>
                            <td colspan="9" class="text-center text-muted">Belum ada data pemesanan.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
