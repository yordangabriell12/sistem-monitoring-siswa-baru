@extends('layouts.app')

@section('title', 'Absensi Siswa')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col">
                <h1 class="h3 mb-0 text-gray-800">Absensi Siswa</h1>
            </div>
        </div>
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row">


                    <form class="form-inline" method="GET" action="{{ route('absensi.index') }}">
                        <div class="form-group mr-2">
                            <label for="kelas_id" class="mr-2">Kelas</label>
                            <select name="kelas_id" id="kelas_id" class="form-control" required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $k)
                                    <option value="{{ $k->id }}" {{ $selectedKelas == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }} - {{ $k->pengajar->mapel->nama_mapel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <label for="tanggal" class="mr-2">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ $tanggal }}">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Tampilkan</button>
                    </form>
                    @if ($selectedKelas)
                        <form method="POST" action="{{ route('absensi.generate') }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="kelas_id" value="{{ $selectedKelas }}">
                            <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                            <button type="submit" class="btn btn-success">Buat Daftar Absensi</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        @if ($selectedKelas && count($absensi))
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
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>No Telp Orang Tua</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->siswa->nama_lengkap }}</td>
                                        <td>
                                            <form action="{{ route('absensi.updateStatus', $item->id) }}" method="POST"
                                                class="form-inline">
                                                @csrf
                                                <select name="status" class="form-control form-control-sm mr-2" required>
                                                    <option value="belum"
                                                        {{ $item->status == 'belum' ? 'selected' : '' }}>Belum Absen
                                                    </option>
                                                    <option value="hadir"
                                                        {{ $item->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                                    <option value="izin" {{ $item->status == 'izin' ? 'selected' : '' }}>
                                                        Izin</option>
                                                    <option value="sakit"
                                                        {{ $item->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                                    <option value="alpa" {{ $item->status == 'alpa' ? 'selected' : '' }}>
                                                        Alpa</option>
                                                </select>
                                        </td>
                                        <td>
                                            <input type="text" name="keterangan" class="form-control form-control-sm"
                                                value="{{ $item->keterangan }}">
                                        </td>
                                        <td>
                                            {{ $item->siswa->no_telp_orangtua }}
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
        @elseif($selectedKelas)
            <div class="alert alert-info">Belum ada data absensi untuk kelas dan tanggal ini. Silakan klik "Buat Daftar
                Absensi".</div>
        @endif
    </div>
@endsection
