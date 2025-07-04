{{-- filepath: c:\laragon\www\sistem-monitoring-siswa\resources\views\pengajar\show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Pengajar')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 mb-0 text-gray-800">Detail Pengajar</h1>
            </div>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Nama Lengkap</dt>
                    <dd class="col-sm-9">{{ $pengajar->nama_lengkap }}</dd>

                    <dt class="col-sm-3">Jenis Kelamin</dt>
                    <dd class="col-sm-9">{{ $pengajar->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>

                    <dt class="col-sm-3">Mata Pelajaran</dt>
                    <dd class="col-sm-9">{{ $pengajar->mapel ? $pengajar->mapel->nama_mapel : '-' }}</dd>
                </dl>
                <a href="{{ route('pengajar.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
</div>
</div>
@endsection
