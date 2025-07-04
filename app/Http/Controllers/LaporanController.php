<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Laporan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporan = Laporan::with('siswa')->get();
        return view('laporan.index', compact('laporan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $siswa = Siswa::all();
        return view('laporan.create', compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required',
                'deskripsi' => 'nullable',
                'file_path' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
                'siswa_id' => 'required|exists:siswa,id',
            ]);

            $file = $request->file('file_path');
            $path = $file->store('laporan', 'public');

            $laporan = Laporan::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'file_path' => $path,
                'siswa_id' => $request->siswa_id,
            ]);

            Log::info('Laporan berhasil ditambahkan.', [
                'laporan_id' => $laporan->id,
                'judul' => $laporan->judul,
            ]);

            return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::info('Gagal menambahkan laporan.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Laporan gagal ditambahkan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $laporan = Laporan::findOrFail($id);
        return view('laporan.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laporan = Laporan::findOrFail($id);
        $siswa = Siswa::all();
        return view('laporan.edit', compact('laporan', 'siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $laporan = Laporan::findOrFail($id);

            $request->validate([
                'judul' => 'required',
                'deskripsi' => 'nullable',
                'file_path' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
                'siswa_id' => 'required|exists:siswa,id',
            ]);

            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'siswa_id' => $request->siswa_id,
            ];

            if ($request->hasFile('file_path')) {
                // Hapus file lama
                if ($laporan->file_path && Storage::disk('public')->exists($laporan->file_path)) {
                    Storage::disk('public')->delete($laporan->file_path);
                }
                $file = $request->file('file_path');
                $data['file_path'] = $file->store('laporan', 'public');
            }

            $laporan->update($data);

            Log::info('Laporan berhasil diupdate.', [
                'laporan_id' => $laporan->id,
                'judul' => $laporan->judul,
            ]);

            return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diupdate.');
        } catch (\Exception $e) {
            Log::info('Gagal mengupdate laporan.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Laporan gagal diupdate.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $laporan = Laporan::findOrFail($id);
            if ($laporan->file_path && Storage::disk('public')->exists($laporan->file_path)) {
                Storage::disk('public')->delete($laporan->file_path);
            }
            $laporan->delete();

            Log::info('Laporan berhasil dihapus.', [
                'laporan_id' => $id,
            ]);

            return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
        } catch (\Exception $e) {
            Log::info('Gagal menghapus laporan.', [
                'error_message' => $e->getMessage(),
            ]);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Laporan gagal dihapus.');
        }
    }
}
