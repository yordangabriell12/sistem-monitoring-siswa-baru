<?php

namespace App\Models;

use App\Models\Pengajar;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\MataPelajaran;

class Dashboard
{
    public static function getStatistik()
    {
        return [
            'jumlahPengajar' => Pengajar::count(),
            'jumlahSiswa' => Siswa::count(),
            'jumlahKelas' => Kelas::count(),
            'jumlahMapel' => MataPelajaran::count(),
        ];
    }
}
