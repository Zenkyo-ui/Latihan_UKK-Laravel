<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

/**
 * CONTROLLER KOMPETENSI
 * ======================
 * Halaman menu "Kompetensi" sekarang menampilkan DATA SKILL
 * (kemampuan bahasa pemrograman yang dikuasai siswa: HTML, CSS, JS, dll).
 *
 * CATATAN PENTING:
 * - Nama menu & URL ( /kompetensi ) TETAP, tapi isi datanya dari tabel skill.
 * - Tabel jurusan (kompetensis: PPLG, TKJ, MM) TETAP ada, tapi hanya
 *   dipakai untuk dropdown "Jurusan" di form siswa — bukan di sini.
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
     * INDEX — Daftar semua skill
     * withCount('siswa') = berapa siswa yang menguasai tiap skill.
     */
    public function index()
    {
        $skillList = Skill::withCount('siswa')->get();

        return view('kompetensi.index', compact('skillList'));
    }

    /**
     * CREATE — Form kosong untuk tambah skill
     */
    public function create()
    {
        return view('kompetensi.create');
    }

    /**
     * STORE — Simpan skill baru
     * 'unique' = nama skill tidak boleh duplikat
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_skill' => 'required|max:100|unique:skills,nama_skill',
            'deskripsi' => 'nullable|max:500',
        ]);

        Skill::create($validated);

        return redirect()->route('kompetensi.index')->with('success', 'Skill berhasil ditambahkan.');
    }

    /**
     * SHOW — Detail skill + daftar siswa yang menguasai
     */
    public function show($id)
    {
        $skill = Skill::withCount('siswa')->with('siswa')->findOrFail($id);

        return view('kompetensi.show', compact('skill'));
    }

    /**
     * EDIT — Form edit skill
     */
    public function edit($id)
    {
        $skill = Skill::findOrFail($id);

        return view('kompetensi.edit', compact('skill'));
    }

    /**
     * UPDATE — Simpan perubahan skill
     * Rule 'unique' di-exclude dari ID sendiri supaya tidak bentrok saat edit.
     */
    public function update(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);

        $validated = $request->validate([
            'nama_skill' => 'required|max:100|unique:skills,nama_skill,' . $skill->id,
            'deskripsi' => 'nullable|max:500',
        ]);

        $skill->update($validated);

        return redirect()->route('kompetensi.index')->with('success', 'Skill berhasil diperbarui.');
    }

    /**
     * DESTROY — Hapus skill
     * Relasi pivot (siswa_skill) otomatis ikut terhapus karena onDelete('cascade').
     */
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return redirect()->route('kompetensi.index')->with('success', 'Skill berhasil dihapus.');
    }
}
