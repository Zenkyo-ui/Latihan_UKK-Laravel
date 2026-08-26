<?php

namespace App\Http\Controllers;

use App\Models\Kompetensi;
use Illuminate\Http\Request;

/**
 * CONTROLLER KOMPETENSI
 * ======================
 * Mengelola CRUD untuk data kompetensi / bidang keahlian.
 * Sama polanya dengan PerusahaanController.
 *
 * ROUTE (dari routes/web.php):
 *   GET    /kompetensi           → index()
 *   GET    /kompetensi/create    → create()
 *   POST   /kompetensi           → store()
 *   GET    /kompetensi/{id}      → show()
 *   GET    /kompetensi/{id}/edit → edit()
 *   PUT    /kompetensi/{id}      → update()
 *   DELETE /kompetensi/{id}      → destroy()
 */
class KompetensiController extends Controller
{
    /**
     * INDEX — Daftar semua kompetensi
     * withCount('siswa') = hitung siswa per kompetensi
     */
    public function index()
    {
        $kompetensiList = Kompetensi::withCount('siswa')->get();

        return view('kompetensi.index', compact('kompetensiList'));
    }

    /**
     * CREATE — Form kosong untuk tambah kompetensi
     */
    public function create()
    {
        return view('kompetensi.create');
    }

    /**
     * STORE — Simpan kompetensi baru
     * 'nullable' = deskripsi boleh kosong
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kompetensi' => 'required|max:100',
            'deskripsi' => 'nullable|max:500',
        ]);

        Kompetensi::create($validated);

        return redirect()->route('kompetensi.index')->with('success', 'Kompetensi berhasil ditambahkan.');
    }

    /**
     * SHOW — Detail kompetensi + daftar siswa
     * with('siswa') = ambil semua siswa di kompetensi ini
     */
    public function show($id)
    {
        $kompetensi = Kompetensi::withCount('siswa')->with('siswa')->findOrFail($id);

        return view('kompetensi.show', compact('kompetensi'));
    }

    /**
     * EDIT — Form edit kompetensi
     */
    public function edit($id)
    {
        $kompetensi = Kompetensi::findOrFail($id);

        return view('kompetensi.edit', compact('kompetensi'));
    }

    /**
     * UPDATE — Simpan perubahan kompetensi
     */
    public function update(Request $request, $id)
    {
        $kompetensi = Kompetensi::findOrFail($id);

        $validated = $request->validate([
            'nama_kompetensi' => 'required|max:100',
            'deskripsi' => 'nullable|max:500',
        ]);

        $kompetensi->update($validated);

        return redirect()->route('kompetensi.index')->with('success', 'Kompetensi berhasil diperbarui.');
    }

    /**
     * DESTROY — Hapus kompetensi
     */
    public function destroy($id)
    {
        $kompetensi = Kompetensi::findOrFail($id);
        $kompetensi->delete();

        return redirect()->route('kompetensi.index')->with('success', 'Kompetensi berhasil dihapus.');
    }
}
