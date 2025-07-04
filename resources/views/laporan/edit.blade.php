@extends('layouts.app')

@section('title', 'Edit Laporan')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 mb-0 text-gray-800">Edit Laporan</h1>
            </div>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('laporan.update', $laporan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul"
                            class="form-control @error('judul') is-invalid @enderror"
                            value="{{ old('judul', $laporan->judul) }}" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $laporan->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="siswa_id">Siswa</label>
                        <select name="siswa_id" id="siswa_id" class="form-control @error('siswa_id') is-invalid @enderror"
                            required>
                            <option value="" disabled>Pilih Siswa</option>
                            @foreach ($siswa as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('siswa_id', $laporan->siswa_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_lengkap }}</option>
                            @endforeach
                        </select>
                        @error('siswa_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="file_path">File Laporan (Ganti file jika perlu)</label>
                        <input type="file" name="file_path" id="file_path"
                            class="form-control @error('file_path') is-invalid @enderror">
                        @if ($laporan->file_path)
                            <small class="form-text text-muted">File saat ini: <a
                                    href="{{ Storage::url($laporan->file_path) }}" target="_blank">Lihat File</a></small>
                        @endif
                        @error('file_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('laporan.index') }}" class="btn btn-secondary mr-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
