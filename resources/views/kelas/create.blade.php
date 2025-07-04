@extends('layouts.app')

@section('title', 'Tambah Kelas')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 mb-0 text-gray-800">Tambah Kelas</h1>
            </div>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('kelas.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas"
                            class="form-control @error('nama_kelas') is-invalid @enderror" value="{{ old('nama_kelas') }}"
                            required>
                        @error('nama_kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="pengajar_id">Pengajar</label>
                        <select name="pengajar_id" id="pengajar_id"
                            class="form-control @error('pengajar_id') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Pengajar</option>
                            @foreach ($pengajar as $item)
                                <option value="{{ $item->id }}" {{ old('pengajar_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        @error('pengajar_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jadwal">Jadwal</label>
                        <input type="text" name="jadwal" id="jadwal"
                            class="form-control @error('jadwal') is-invalid @enderror" value="{{ old('jadwal') }}" required>
                        @error('jadwal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('kelas.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
