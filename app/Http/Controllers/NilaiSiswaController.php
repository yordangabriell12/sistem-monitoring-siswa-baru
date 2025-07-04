<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nilai;
use App\Models\Pengajar;
use App\Models\MataPelajaran;

class NilaiSiswaController extends Controller
{
    public function index()
    {
        $siswaId = Auth::user()->siswa_id;

        // Ambil data nilai beserta relasi kelas dan mapel
        $nilaiList = Nilai::where('siswa_id', $siswaId)
            ->with(['kelas', 'mapel'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('nilai_siswa.index', compact('nilaiList'));
    }
}
