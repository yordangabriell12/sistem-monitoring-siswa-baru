@extends('layouts.app')

@section('title', 'Nilai Siswa')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 mb-0 text-gray-800">Nilai Siswa</h1>
            </div>
        </div>
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row">
                    <form class="form-inline" method="GET" action="{{ route('nilai.index') }}">
                        <div class="form-group mr-2">
                            <label for="kelas_id" class="mr-2">Kelas & Mapel</label>
                            <select name="kelas_id" id="kelas_id" class="form-control" required>
                                <option value="">Pilih Kelas & Mapel</option>
                                @foreach ($kelas as $k)
                                    @if ($k->pengajar && $k->pengajar->mapel)
                                        <option value="{{ $k->id }}" data-mapel="{{ $k->pengajar->mapel->id }}"
                                            {{ $selectedKelas == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kelas }} - {{ $k->pengajar->mapel->nama_mapel }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="mapel_id" id="mapel_id" value="{{ $selectedMapel ?? '' }}">
                        <div class="form-group mr-2">
                            <label for="jenis_nilai" class="mr-2">Jenis Penilaian</label>
                            <select name="jenis_nilai" id="jenis_nilai" class="form-control" required>
                                <option value="">Pilih Jenis</option>
                                @foreach ($jenisList as $jenis)
                                    <option value="{{ $jenis }}" {{ $jenis_nilai == $jenis ? 'selected' : '' }}>
                                        {{ ucfirst($jenis) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Tampilkan</button>
                    </form>
                    @if ($selectedKelas && $jenis_nilai)
                        <form method="POST" action="{{ route('nilai.generate') }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="kelas_id" value="{{ $selectedKelas }}">
                            <input type="hidden" name="mapel_id" id="mapel_id_post" value="{{ $selectedMapel ?? '' }}">
                            <input type="hidden" name="jenis_nilai" value="{{ $jenis_nilai }}">
                            <button type="submit" class="btn btn-success">Buat Daftar Nilai</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        @if ($selectedKelas && $jenis_nilai && count($nilai))
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->siswa->nama_lengkap }}</td>
                                        <td>
                                            <form action="{{ route('nilai.updateNilai', $item->id) }}" method="POST"
                                                class="form-inline">
                                                @csrf
                                                <input type="number" name="nilai"
                                                    class="form-control form-control-sm mr-2" value="{{ $item->nilai }}"
                                                    min="0" max="100" required>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @elseif($selectedKelas && $jenis_nilai)
            <div class="alert alert-info">Belum ada data nilai untuk filter ini. Silakan klik "Buat Daftar Nilai".</div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        // Otomatis set mapel_id hidden saat kelas dipilih
        $(document).ready(function() {
            $('#kelas_id').on('change', function() {
                var mapelId = $(this).find(':selected').data('mapel') || '';
                $('#mapel_id').val(mapelId);
                $('#mapel_id_post').val(mapelId);
            });
            // Trigger on page load
            $('#kelas_id').trigger('change');
        });
    </script>
@endpush
