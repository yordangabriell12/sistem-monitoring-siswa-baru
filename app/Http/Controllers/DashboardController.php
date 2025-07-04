<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\Pengajar;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\MataPelajaran;

class DashboardController extends Controller
{
    public function index()
    {
        $umlahPengajar = count(Pengajar::all());
        $umlahSiswa = Siswa::count();
        $umlahKelas = Kelas::count();
        $umlahMapel = MataPelajaran::count();

        return view('dashboard', [
            'jumlahPengajar' => $umlahPengajar,
            'jumlahSiswa' => $umlahSiswa,
            'jumlahKelas' => $umlahKelas,
            'jumlahMapel' => $umlahMapel,
        ]);
    }
}
