<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Support\Facades\Log;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kelas = Kelas::all();
        $mapel = MataPelajaran::all();
        $selectedKelas = $request->kelas_id;
        $selectedMapel = $request->mapel_id;
        $jenis_nilai = $request->jenis_nilai;
        $jenisList = ['tugas', 'ujian', 'kuis'];
        $nilai = [];

        if ($selectedKelas && $selectedMapel && $jenis_nilai) {
            $nilai = Nilai::with('siswa')
                ->where('kelas_id', $selectedKelas)
                ->where('mapel_id', $selectedMapel)
                ->where('jenis_nilai', $jenis_nilai)
                ->get();
        }

        return view('nilai.index', compact('kelas', 'mapel', 'selectedKelas', 'selectedMapel', 'jenis_nilai', 'jenisList', 'nilai'));
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
                'mapel_id' => 'required|exists:mata_pelajaran,id',
                'jenis_nilai' => 'required|in:tugas,ujian,kuis',
            ]);

            $kelas_id = $request->kelas_id;
            $mapel_id = $request->mapel_id;
            $jenis_nilai = $request->jenis_nilai;

            $siswaList = Siswa::where('kelas_id', $kelas_id)->get();

            foreach ($siswaList as $siswa) {
                Nilai::firstOrCreate([
                    'siswa_id' => $siswa->id,
                    'kelas_id' => $kelas_id,
                    'mapel_id' => $mapel_id,
                    'jenis_nilai' => $jenis_nilai,
                ], [
                    'nilai' => 0,
                ]);
            }

            Log::info('Nilai berhasil dibuat.', [
                'kelas_id' => $kelas_id,
                'mapel_id' => $mapel_id,
                'jenis_nilai' => $jenis_nilai,
                'jumlah_siswa' => count($siswaList),
            ]);

            return redirect()->route('nilai.index', [
                'kelas_id' => $kelas_id,
                'mapel_id' => $mapel_id,
                'jenis_nilai' => $jenis_nilai,
            ])->with('success', 'Data nilai berhasil dibuat.');
        } catch (\Exception $e) {
            Log::info('Gagal generate nilai.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Gagal membuat nilai: ' . $e->getMessage());
        }
    }

    public function updateNilai(Request $request, $id)
    {
        try {
            $request->validate([
                'nilai' => 'required|numeric|min:0|max:100',
            ]);

            $nilai = Nilai::findOrFail($id);
            $nilai->nilai = $request->nilai;
            $nilai->save();

            Log::info('Nilai berhasil diubah.', [
                'nilai_id' => $id,
                'nilai' => $request->nilai,
            ]);

            return back()->with('success', 'Nilai berhasil diubah.');
        } catch (\Exception $e) {
            Log::info('Gagal mengubah nilai.', [
                'error_message' => $e->getMessage(),
            ]);
            return back()->with('error', 'Gagal mengubah nilai: ' . $e->getMessage());
        }
    }
}
