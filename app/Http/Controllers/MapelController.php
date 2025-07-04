<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Log;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapel = MataPelajaran::all();
        return view('mapel.index', compact('mapel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mapel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_mapel' => 'required',
                'kode_mapel' => 'required|unique:mata_pelajaran,kode_mapel',
            ]);

            $mapel = MataPelajaran::create($request->all());

            Log::info('Mapel berhasil ditambahkan.', [
                'mapel_id' => $mapel->id,
                'nama_mapel' => $mapel->nama_mapel,
            ]);

            return redirect()->route('mapel.index')->with('success', 'Data mapel berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::info('Gagal menambahkan mapel.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data mapel gagal ditambahkan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $mapel = MataPelajaran::findOrFail($id);
            return view('mapel.show', compact('mapel'));
        } catch (\Exception $e) {
            Log::info('Gagal menampilkan detail mapel.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->route('mapel.index')->with('error', 'Data mapel tidak ditemukan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $mapel = MataPelajaran::findOrFail($id);
            return view('mapel.edit', compact('mapel'));
        } catch (\Exception $e) {
            Log::info('Gagal menampilkan form edit mapel.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->route('mapel.index')->with('error', 'Data mapel tidak ditemukan.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $mapel = MataPelajaran::findOrFail($id);

            $request->validate([
                'nama_mapel' => 'required',
                'kode_mapel' => 'required|unique:mata_pelajaran,kode_mapel,' . $mapel->id,

            ]);

            $mapel->update($request->all());

            Log::info('Data mapel berhasil diupdate.', [
                'mapel_id' => $mapel->id,
                'nama_mapel' => $mapel->nama_mapel,
            ]);

            return redirect()->route('mapel.index')->with('success', 'Data mapel berhasil diupdate.');
        } catch (\Exception $e) {
            Log::info('Gagal mengupdate data mapel.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data mapel gagal diupdate.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $mapel = MataPelajaran::findOrFail($id);
            $mapel->delete();

            Log::info('Data mapel berhasil dihapus.', [
                'mapel_id' => $id,
            ]);

            return redirect()->route('mapel.index')->with('success', 'Data mapel berhasil dihapus.');
        } catch (\Exception $e) {
            Log::info('Gagal menghapus data mapel.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Data mapel gagal dihapus.');
        }
    }
}
