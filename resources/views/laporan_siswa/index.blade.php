@extends('layouts.app')

@section('title', 'Laporan Saya')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 mb-0 text-gray-800">Laporan Saya</h1>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>File</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($laporanList as $laporan)
                                <tr>
                                    <td>{{ $laporan->siswa ? $laporan->siswa->nama_lengkap : '-' }}</td>
                                    <td>{{ $laporan->judul }}</td>
                                    <td>{{ $laporan->deskripsi ?? '-' }}</td>
                                    <td>
                                        @if ($laporan->file_path)
                                            <a href="{{ asset('storage/' . $laporan->file_path) }}"
                                                target="_blank">Download</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $laporan->created_at ? $laporan->created_at->format('d-m-Y') : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data laporan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
