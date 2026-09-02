<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Kompetensi;
use Illuminate\Http\Request;

/**
 * CONTROLLER KOMPETENSI
 * ======================
 * Halaman menu "Kompetensi" menampilkan DATA SKILL
 * (kemampuan yang dikuasai siswa sesuai jurusan).
 *
 * CATATAN PENTING:
 * - Nama menu & URL ( /kompetensi ) TETAP.
 * - Menampilkan data skill + relasi skill ↔ jurusan (pivot kompetensi_skill).
 * - Tabel jurusan (PPLG, TKJ, MM) dipakai sebagai KATEGORI skill
 *   dan untuk dropdown "Jurusan" di form siswa.
 *
 * ROUTE (dari routes/web.php):
 *   GET    /kompetensi                    → index()
 *   GET    /kompetensi/create             → create()
 *   POST   /kompetensi                    → store()
 *   GET    /kompetensi/{id}               → show()
 *   GET    /kompetensi/{id}/edit          → edit()
 *   PUT    /kompetensi/{id}               → update()
 *   DELETE /kompetensi/{id}               → destroy()
 *   GET    /kompetensi/{id}/skills        → skillsByKompetensi() [AJAX JSON]
 */
class KompetensiController extends Controller
{
    /**
     * INDEX — Daftar semua skill + jurusan pemakainya
     * withCount('siswa') = berapa siswa yang menguasai tiap skill.
     * with('kompetensi') = jurusan mana saja yang memakai skill ini.
     */
    public function index()
    {
        $skillList = Skill::withCount('siswa')->with('kompetensi')->get();

        return view('kompetensi.index', compact('skillList'));
    }

    /**
     * CREATE — Form tambah skill.
     * Kirim daftar jurusan supaya nanti bisa dicentang (relasi skill↔jurusan).
     */
    public function create()
    {
        $kompetensiList = Kompetensi::all();

        return view('kompetensi.create', compact('kompetensiList'));
    }

    /**
     * STORE — Simpan skill baru + relasi skill↔jurusan.
     * 'unique' = nama skill tidak boleh duplikat.
     * kompetensi_ids = array jurusan yang dicentang (boleh null).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_skill' => 'required|max:100|unique:skills,nama_skill',
            'deskripsi' => 'nullable|max:500',
            'kompetensi_ids' => 'nullable|array',
            'kompetensi_ids.*' => 'exists:kompetensis,id',
        ]);

        $skill = Skill::create($validated);

        // sync() = set jurusan mana yang memakai skill ini
        // (kalau tidak ada checkbox dicentang → array kosong)
        $skill->kompetensi()->sync($request->kompetensi_ids ?? []);

        return redirect()->route('kompetensi.index')->with('success', 'Skill berhasil ditambahkan.');
    }

    /**
     * SHOW — Detail skill + jurusan pemakai + siswa yang menguasai.
     * with('kompetensi','siswa') = ambil relasi sekaligus (hindari N+1 query).
     */
    public function show($id)
    {
        $skill = Skill::withCount('siswa')->with(['kompetensi', 'siswa'])->findOrFail($id);

        return view('kompetensi.show', compact('skill'));
    }

    /**
     * EDIT — Form edit skill.
     * Kirim jurusan + skill yang sudah punya jurusan (buat pre-check checkbox).
     */
    public function edit($id)
    {
        $skill = Skill::with('kompetensi')->findOrFail($id);
        $kompetensiList = Kompetensi::all();

        return view('kompetensi.edit', compact('skill', 'kompetensiList'));
    }

    /**
     * UPDATE — Simpan perubahan skill + relasi skill↔jurusan.
     * Rule 'unique' di-exclude dari ID sendiri supaya tidak bentrok saat edit.
     */
    public function update(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);

        $validated = $request->validate([
            'nama_skill' => 'required|max:100|unique:skills,nama_skill,' . $skill->id,
            'deskripsi' => 'nullable|max:500',
            'kompetensi_ids' => 'nullable|array',
            'kompetensi_ids.*' => 'exists:kompetensis,id',
        ]);

        $skill->update($validated);

        // sync() kembali relasi skill↔jurusan sesuai checkbox terbaru
        $skill->kompetensi()->sync($request->kompetensi_ids ?? []);

        return redirect()->route('kompetensi.index')->with('success', 'Skill berhasil diperbarui.');
    }

    /**
     * DESTROY — Hapus skill.
     * Relasi pivot (siswa_skill & kompetensi_skill) ikut terhapus via cascade.
     */
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return redirect()->route('kompetensi.index')->with('success', 'Skill berhasil dihapus.');
    }

    /**
     * SKILLS BY KOMPETENSI — Endpoint AJAX (kembalikan JSON, bukan HTML).
     * ================================================================
     * Dipakai form siswa: saat user memilih jurusan, JavaScript memanggil
     * URL ini untuk mengambil daftar skill milik jurusan tsb, lalu
     * checkbox "Skill yang Dikuasai" di-render ulang dari hasil JSON.
     *
     * Contoh response:
     *   [ {"id": 8, "nama_skill": "Pemrograman OOP", "deskripsi": "..."}, ... ]
     */
    public function skillsByKompetensi($id)
    {
        $kompetensi = Kompetensi::with('skills')->findOrFail($id);

        return response()->json($kompetensi->skills);
    }
}