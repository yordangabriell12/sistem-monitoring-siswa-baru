{{-- resources/views/siswa/edit.blade.php --}}
@extends('layouts.app')  {{-- atau layout yang kamu pakai --}}

@section('content')
<div class="container">
  <h1>Edit Data Siswa</h1>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
      <input type="text" 
             name="nama_lengkap" 
             id="nama_lengkap" 
             class="form-control" 
             value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}" 
             required>
    </div>

    <div class="mb-3">
      <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
      <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
        <option value="L" {{ $siswa->jenis_kelamin=='L'?'selected':'' }}>Laki-laki</option>
        <option value="P" {{ $siswa->jenis_kelamin=='P'?'selected':'' }}>Perempuan</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="kelas_id" class="form-label">Kelas</label>
      <select name="kelas_id" id="kelas_id" class="form-select" required>
        @foreach($kelas as $k)
          <option value="{{ $k->id }}" {{ $siswa->kelas_id == $k->id ? 'selected' : '' }}>
            {{ $k->nama_kelas }}  {{-- sesuaikan field nama_kelas --}}
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="nama_orangtua" class="form-label">Nama Orangtua</label>
      <input type="text" 
             name="nama_orangtua" 
             id="nama_orangtua" 
             class="form-control" 
             value="{{ old('nama_orangtua', $siswa->nama_orangtua) }}">
    </div>

    <div class="mb-3">
      <label for="no_telp_orangtua" class="form-label">No. Telepon Orangtua</label>
      <input type="text" 
             name="no_telp_orangtua" 
             id="no_telp_orangtua" 
             class="form-control" 
             value="{{ old('no_telp_orangtua', $siswa->no_telp_orangtua) }}">
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Batal</a>
  </form>
</div>
@endsection
