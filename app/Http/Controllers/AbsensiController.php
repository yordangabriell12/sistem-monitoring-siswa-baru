<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pengajar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelas = Kelas::all();
        $selectedKelas = $request->kelas_id;
        $tanggal = $request->tanggal ?? date('Y-m-d');
        $absensi = [];

        if ($selectedKelas) {
            $absensi = Absensi::with(['siswa', 'pengajar'])
                ->whereHas('siswa', function ($q) use ($selectedKelas) {
                    $q->where('kelas_id', $selectedKelas);
                })
                ->where('tanggal', $tanggal)
                ->get();
        }

        return view('absensi.index', compact('kelas', 'selectedKelas', 'tanggal', 'absensi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function generate(Request $request)
    {

        try {
            $request->validate([
                'kelas_id' => 'required|exists:kelas,id',
                'tanggal' => 'required|date',
            ]);

            $kelas_id = $request->kelas_id;
            $tanggal = $request->tanggal;
            $pengajar_id = Kelas::find($kelas_id)->pengajar_id ?? null;

            $siswaList = Siswa::where('kelas_id', $kelas_id)->get();

            foreach ($siswaList as $siswa) {
                Absensi::firstOrCreate([
                    'siswa_id' => $siswa->id,
                    'tanggal' => $tanggal,
                ], [
                    'pengajar_id' => $pengajar_id,
                    'status' => 'belum',
                    'keterangan' => null,
                ]);
            }

            Log::info('Absensi berhasil dibuat.', [
                'kelas_id' => $kelas_id,
                'tanggal' => $tanggal,
                'jumlah_siswa' => count($siswaList),
            ]);

            return redirect()->route('absensi.index', [
                'kelas_id' => $kelas_id,
                'tanggal' => $tanggal,
            ])->with('success', 'Absensi berhasil dibuat.');
        } catch (\Exception $e) {
            Log::info('Gagal generate absensi.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Gagal membuat absensi: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:hadir,izin,sakit,alpa',
                'keterangan' => 'nullable|string',
            ]);

            $absensi = Absensi::findOrFail($id);
            $absensi->status = $request->status;
            $absensi->keterangan = $request->keterangan;
            $absensi->save();

            Log::info('Status absensi berhasil diubah.', [
                'absensi_id' => $id,
                'status' => $request->status,
            ]);

            return back()->with('success', 'Status absensi berhasil diubah.');
        } catch (\Exception $e) {
            Log::info('Gagal mengubah status absensi.', [
                'error_message' => $e->getMessage(),
            ]);
            return back()->with('error', 'Gagal mengubah status absensi: ' . $e->getMessage());
        }
    }
}
