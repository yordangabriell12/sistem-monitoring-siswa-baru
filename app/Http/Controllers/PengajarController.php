<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajar;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Log;

class PengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajar = Pengajar::with('mapel')->get();
        return view('pengajar.index', compact('pengajar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mapel = MataPelajaran::all();
        return view('pengajar.create', compact('mapel'));
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
                'mapel_id' => 'required|exists:mata_pelajaran,id',
            ]);

            $pengajar = Pengajar::create($request->all());

            Log::info('Pengajar berhasil ditambahkan.', [
                'pengajar_id' => $pengajar->id,
                'nama_lengkap' => $pengajar->nama_lengkap,
            ]);

            return redirect()->route('pengajar.index')->with('success', 'Data pengajar berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::info('Gagal menambahkan pengajar.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data pengajar gagal ditambahkan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengajar = Pengajar::with('mapel')->findOrFail($id);
        return view('pengajar.show', compact('pengajar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengajar = Pengajar::findOrFail($id);
        $mapel = MataPelajaran::all();
        return view('pengajar.edit', compact('pengajar', 'mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $pengajar = Pengajar::findOrFail($id);

            $request->validate([
                'nama_lengkap' => 'required',
                'jenis_kelamin' => 'required|in:L,P',
                'mapel_id' => 'required|exists:mata_pelajaran,id',
            ]);

            $pengajar->update($request->all());

            Log::info('Data pengajar berhasil diupdate.', [
                'pengajar_id' => $pengajar->id,
                'nama_lengkap' => $pengajar->nama_lengkap,
            ]);

            return redirect()->route('pengajar.index')->with('success', 'Data pengajar berhasil diupdate.');
        } catch (\Exception $e) {
            Log::info('Gagal mengupdate data pengajar.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data pengajar gagal diupdate.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $pengajar = Pengajar::findOrFail($id);
            $pengajar->delete();

            Log::info('Data pengajar berhasil dihapus.', [
                'pengajar_id' => $id,
            ]);

            return redirect()->route('pengajar.index')->with('success', 'Data pengajar berhasil dihapus.');
        } catch (\Exception $e) {
            Log::info('Gagal menghapus data pengajar.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data pengajar gagal dihapus.');
        }
    }
}
