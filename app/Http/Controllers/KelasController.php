<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Pengajar;
use Illuminate\Support\Facades\Log;


class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with('pengajar')->get();
        return view('kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pengajar = Pengajar::all();
        return view('kelas.create', compact('pengajar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_kelas' => 'required',
                'pengajar_id' => 'required|exists:pengajar,id',
                'jadwal' => 'required',
            ]);

            $kelas = Kelas::create($request->all());

            // Log kalau berhasil
            Log::info('Kelas berhasil ditambahkan.', [
                'kelas_id' => $kelas->id,
                'nama_kelas' => $kelas->nama_kelas,
            ]);

            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Log kalau ada error
            Log::info('Gagal menambahkan kelas.', [
                'error_message' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan. Data kelas gagal ditambahkan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $kelas = Kelas::with('pengajar')->findOrFail($id);
            return view('kelas.show', compact('kelas'));
        } catch (\Exception $e) {
            Log::info('Gagal menampilkan detail kelas.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->route('kelas.index')->with('error', 'Data kelas tidak ditemukan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $kelas = Kelas::findOrFail($id);
            $pengajar = Pengajar::all();
            return view('kelas.edit', compact('kelas', 'pengajar'));
        } catch (\Exception $e) {
            Log::info('Gagal menampilkan form edit kelas.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->route('kelas.index')->with('error', 'Data kelas tidak ditemukan.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $kelas = Kelas::findOrFail($id);

            $request->validate([
                'nama_kelas' => 'required',
                'pengajar_id' => 'required|exists:pengajar,id',
                'jadwal' => 'required',
            ]);

            $kelas->update($request->all());

            Log::info('Data kelas berhasil diupdate.', [
                'kelas_id' => $kelas->id,
                'nama_kelas' => $kelas->nama_kelas,
            ]);

            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diupdate.');
        } catch (\Exception $e) {
            Log::info('Gagal mengupdate data kelas.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data kelas gagal diupdate.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kelas = Kelas::findOrFail($id);
            $kelas->delete();

            Log::info('Data kelas berhasil dihapus.', [
                'kelas_id' => $id,
            ]);

            return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
        } catch (\Exception $e) {
            Log::info('Gagal menghapus data kelas.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data kelas gagal dihapus.');
        }
    }
}
