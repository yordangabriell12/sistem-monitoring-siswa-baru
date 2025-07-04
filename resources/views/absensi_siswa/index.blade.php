@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 mb-0 text-gray-800">Absensi</h1>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Tanggal</th>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($absensiList as $absen)
                                <tr>
                                    <td>{{ $absen->siswa ? $absen->siswa->nama_lengkap : '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $absen->pengajar && $absen->pengajar->kelas ? $absen->pengajar->kelas->nama_kelas : '-' }}
                                    </td>
                                    <td>{{ $absen->pengajar && $absen->pengajar->mapel ? $absen->pengajar->mapel->nama_mapel : '-' }}
                                    </td>
                                    <td>{{ ucfirst($absen->status) }}</td>
                                    <td>{{ $absen->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data absensi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
