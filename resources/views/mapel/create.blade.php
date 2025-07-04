@extends('layouts.app')

@section('title', 'Tambah Mapel')
@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 mb-0 text-gray-800">Tambah Mata Pelajaran</h1>
            </div>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('mapel.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nama_mapel">Nama Mapel</label>
                        <input type="text" name="nama_mapel" id="nama_mapel"
                            class="form-control @error('nama_mapel') is-invalid @enderror" value="{{ old('nama_mapel') }}"
                            required>
                        @error('nama_mapel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kode_mapel">Kode Mapel</label>
                        <input type="text" name="kode_mapel" id="kode_mapel"
                            class="form-control @error('kode_mapel') is-invalid @enderror" value="{{ old('kode_mapel') }}"
                            required>
                        @error('kode_mapel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <div class="d-flex justify-content-end">
                        <a href="{{ route('mapel.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
