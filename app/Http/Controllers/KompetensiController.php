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
     * INDEX — Daftar semua jurusan + jumlah skill tiap jurusan.
     * Saat halaman dibuka, tampilkan daftar jurusan (nama + jumlah skill).
     * Skill per jurusan dimuat lewat AJAX (skillsByKompetensi) saat dropdown dipilih.
     */
    public function index()
    {
        $kompetensiList = Kompetensi::withCount('skills')->orderBy('nama_kompetensi')->get();

        return view('kompetensi.index', compact('kompetensiList'));
    }

    /**
     * CREATE — Form tambah skill.
     * Kirim daftar jurusan (bisa dicentang, relasi skill↔jurusan).
     * Mendukung query ?jurusan=id untuk pre-check jurusan yang sedang dipilih
     * (saat tombol "+ Tambah Skill" diklik dari halaman Kompetensi).
     */
    public function create()
    {
        $kompetensiList = Kompetensi::all();
        $defaultJurusan = (int) request('jurusan'); // 0 = tidak ada jurusan terpilih

        return view('kompetensi.create', compact('kompetensiList', 'defaultJurusan'));
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
        $jurusan = Kompetensi::findOrFail($id);

        $skills = Skill::whereHas('kompetensi', function ($q) use ($id) {
            $q->where('kompetensi_id', $id);
        })->withCount('siswa')->orderBy('nama_skill')->get();

        return response()->json($skills);
    }
}