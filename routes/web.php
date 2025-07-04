<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AbsensiSiswaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\NilaiSiswaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanSiswaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('auth');

Route::middleware(['role:admin'])->group(function () {
    Route::resource('mapel', MapelController::class);
    Route::resource('pengajar', PengajarController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('laporan', LaporanController::class);

    Route::get('absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::post('absensi/generate', [AbsensiController::class, 'generate'])->name('absensi.generate');
    Route::post('absensi/{id}/update-status', [AbsensiController::class, 'updateStatus'])->name('absensi.updateStatus');

    Route::get('nilai', [NilaiController::class, 'index'])->name('nilai.index');
    Route::post('nilai/generate', [NilaiController::class, 'generate'])->name('nilai.generate');
    Route::post('nilai/{id}/update-nilai', [NilaiController::class, 'updateNilai'])->name('nilai.updateNilai');
});

Route::middleware(['role:siswa'])->group(function () {
    Route::get('absensi_siswa', [AbsensiSiswaController::class, 'index'])->name('absensi_siswa.index');
    Route::get('nilai_siswa', [NilaiSiswaController::class, 'index'])->name('nilai_siswa.index');
    Route::get('laporan_siswa', [LaporanSiswaController::class, 'index'])->name('laporan_siswa.index');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
