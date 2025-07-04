<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Log;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::with('kelas')->get();
        return view('siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('siswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_lengkap' => 'required',
                'jenis_kelamin' => 'required|in:L,P',
                'kelas_id' => 'required|exists:kelas,id',
                'nama_orangtua' => 'required',
                'no_telp_orangtua' => 'required',
            ]);

            $siswa = Siswa::create($request->all());

            // Log kalau berhasil
            Log::info('Siswa berhasil ditambahkan.', [
                'siswa_id' => $siswa->id,
                'nama_lengkap' => $siswa->nama_lengkap,
            ]);


            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Log kalau ada error
            Log::info('Gagal menambahkan siswa.', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan. Data siswa gagal ditambahkan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::with('kelas')->findOrFail($id);
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $siswa = Siswa::findOrFail($id);

            $request->validate([
                'nama_lengkap' => 'required',
                'jenis_kelamin' => 'required|in:L,P',
                'kelas_id' => 'required|exists:kelas,id',
                'nama_orangtua' => 'required',
                'no_telp_orangtua' => 'required',
            ]);

            $siswa->update($request->all());

            // Log kalau berhasil
            Log::info('Data siswa berhasil diupdate.', [
                'siswa_id' => $siswa->id,
                'nama_lengkap' => $siswa->nama_lengkap,
            ]);

            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diupdate.');
        } catch (\Exception $e) {
            // Log kalau ada error
            Log::info('Gagal mengupdate data siswa.', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan. Data siswa gagal diupdate.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $siswa = Siswa::findOrFail($id);
            $siswa->delete();

            // Log kalau berhasil
            Log::info('Data siswa berhasil dihapus.', [
                'siswa_id' => $id,
            ]);

            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
        } catch (\Exception $e) {
            // Log kalau ada error
            Log::info('Gagal menghapus data siswa.', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan. Data siswa gagal dihapus.');
        }
    }
}
