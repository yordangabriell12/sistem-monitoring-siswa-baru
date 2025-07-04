@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 mb-0 text-gray-800">Detail Laporan</h1>
            </div>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Judul</dt>
                    <dd class="col-sm-9">{{ $laporan->judul }}</dd>

                    <dt class="col-sm-3">Deskripsi</dt>
                    <dd class="col-sm-9">{{ $laporan->deskripsi }}</dd>

                    <dt class="col-sm-3">File</dt>
                    <dd class="col-sm-9">
                        @if ($laporan->file_path)
                            <a href="{{ asset('storage/' . $laporan->file_path) }}" target="_blank">Download</a>
                        @else
                            -
                        @endif
                    </dd>
                </dl>
                <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
