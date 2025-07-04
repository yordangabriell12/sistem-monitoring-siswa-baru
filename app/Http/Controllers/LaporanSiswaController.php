<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;

class LaporanSiswaController extends Controller
{
    public function index()
    {
        $siswaId = Auth::user()->siswa_id;
        $laporanList = Laporan::with('siswa')
            ->where('siswa_id', $siswaId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('laporan_siswa.index', compact('laporanList'));
    }
}
