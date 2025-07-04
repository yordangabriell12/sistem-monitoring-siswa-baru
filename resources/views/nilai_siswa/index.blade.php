@extends('layouts.app')

@section('title', 'Nilai Siswa')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 mb-0 text-gray-800">Nilai Siswa</h1>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Jenis Nilai</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($nilaiList as $nilai)
                                <tr>
                                    <td>{{ $nilai->kelas ? $nilai->kelas->nama_kelas : '-' }}</td>
                                    <td>{{ $nilai->mapel ? $nilai->mapel->nama_mapel : '-' }}</td>
                                    <td>{{ $nilai->jenis_nilai ?? '-' }}</td>
                                    <td>{{ $nilai->nilai ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data nilai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
