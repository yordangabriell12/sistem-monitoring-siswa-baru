<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;

class AbsensiSiswaController extends Controller
{
    public function index()
    {
        $siswaId = Auth::user()->siswa_id;

        // Eager load pengajar beserta kelas dan mapel
        $absensiList = Absensi::where('siswa_id', $siswaId)
            ->with(['pengajar.kelas', 'pengajar.mapel'])
            ->orderBy('tanggal', 'desc')
            ->get();

        // Tidak perlu mapping manual, cukup kirim ke view
        return view('absensi_siswa.index', compact('absensiList'));
    }
}
