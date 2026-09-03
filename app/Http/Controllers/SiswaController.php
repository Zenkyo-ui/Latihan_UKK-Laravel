<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Perusahaan;
use App\Models\Kompetensi;
use Illuminate\Http\Request;

/**
 * CONTROLLER SISWA
 * =================
 * Mengelola CRUD untuk data siswa PKL.
 *
 * BEDA DENGAN PERUSAHAAN:
 * Di sini parameter route pakai 'nis' (Nomor Induk Siswa), bukan 'id'.
 * Contoh: /siswa/22231001 (bukan /siswa/1)
 *
 * ROUTE (dari routes/web.php):
 *   GET    /siswa           → index()
 *   GET    /siswa/create    → create()
 *   POST   /siswa           → store()
 *   GET    /siswa/{nis}     → show()
 *   GET    /siswa/{nis}/edit → edit()
 *   PUT    /siswa/{nis}     → update()
 *   DELETE /siswa/{nis}     → destroy()
 */
class SiswaController extends Controller
{
    /**
     * INDEX — Daftar semua siswa
     * ==========================
     * with('perusahaan', 'kompetensi') = ambil data perusahaan + kompetensi
     * bersamaan supaya tidak ada N+1 query problem.
     *
     * Tanpa with(), setiap $siswa->perusahaan akan trigger 1 query baru.
     * Dengan with(), semua data diambil sekaligus dalam 3 query.
     */
    public function index()
    {
        $siswaList = Siswa::with('perusahaan', 'kompetensi', 'skills')->paginate(10);

        return view('siswa.index', compact('siswaList'));
    }

    /**
     * CREATE — Form tambah siswa
     * ==========================
     * Kirim 2 data ke view:
     * 1. $perusahaanList = daftar perusahaan (untuk dropdown)
     * 2. $kompetensiList = daftar kompetensi (untuk dropdown)
     *
     * withCount('siswa') = supaya di dropdown bisa tampilkan sisa kuota.
     */
    public function create()
    {
        $perusahaanList = Perusahaan::withCount('siswa')->get();
        $kompetensiList = Kompetensi::all();

        return view('siswa.create', compact('perusahaanList', 'kompetensiList'));
    }

    /**
     * STORE — Simpan siswa baru
     * =========================
     * Aturan validasi:
     *   'unique:siswas,nis'             = NIS harus unik di tabel siswas
     *   'after_or_equal:tanggal_mulai_pkl' = tanggal selesai harus setelah/sama dengan mulai
     *   'exists:perusahaans,id'         = perusahaan_id harus ada di tabel perusahaans
     *   'exists:kompetensis,id'         = kompetensi_id harus ada di tabel kompetensis
     *
     * Siswa::create($validated) otomatis isi kolom yang ada di $fillable.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|max:20|unique:siswas,nis',
            'nama' => 'required|max:100',
            'kelas' => 'required|max:30',
            'tanggal_mulai_pkl' => 'required|date',
            'tanggal_selesai_pkl' => 'required|date|after_or_equal:tanggal_mulai_pkl',
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'kompetensi_id' => 'required|exists:kompetensis,id',
            // skill_ids = array id skill yang dikuasai. 'array' = wajib berupa array.
            'skill_ids' => 'nullable|array',
            'skill_ids.*' => 'exists:skills,id',
        ]);

        // Simpan siswa dulu (return object-nya) supaya bisa dipakai untuk relasi skill
        $siswa = Siswa::create($validated);

        // sync = sinkronkan relasi many-to-many: set skill yang dikuasai siswa ini.
        // Kalau tidak ada pilihan, sync array kosong → hapus semua relasi skill.
        $siswa->skills()->sync($request->skill_ids ?? []);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * SHOW — Detail 1 siswa
     * ======================
     * Cari siswa berdasarkan NIS (bukan ID).
     * where('nis', $nis)->firstOrFail() = cari berdasarkan NIS, kalau tidak ada → 404.
     */
    public function show($nis)
    {
        $siswa = Siswa::with('perusahaan', 'kompetensi', 'skills')->where('nis', $nis)->firstOrFail();

        return view('siswa.show', compact('siswa'));
    }

    /**
     * EDIT — Form edit siswa
     * =======================
     * Kirim data siswa + daftar perusahaan + daftar kompetensi ke view.
     * Di view, form akan terisi otomatis dengan data lama via old('field', $siswa->field).
     */
    public function edit($nis)
    {
        $siswa = Siswa::with('skills')->where('nis', $nis)->firstOrFail();
        $perusahaanList = Perusahaan::all();
        $kompetensiList = Kompetensi::all();

        return view('siswa.edit', compact('siswa', 'perusahaanList', 'kompetensiList'));
    }

    /**
     * UPDATE — Simpan perubahan data siswa
     * =====================================
     * unique:siswas,nis,{siswa->nis},nis = validasi unik, TAPI kecuali NIS sendiri.
     * Ini diperlukan supaya saat edit, NIS yang sama tidak dianggap duplikat.
     *
     * Contoh: Siswa Ahmad punya NIS 22231001.
     * Saat edit, NIS tetap 22231001 → valid (tidak duplikat).
     * Kalau ada siswa lain pakai NIS 22231001 → invalid (duplikat).
     */
    public function update(Request $request, $nis)
    {
        $siswa = Siswa::where('nis', $nis)->firstOrFail();

        $validated = $request->validate([
            'nis' => 'required|max:20|unique:siswas,nis,' . $siswa->nis . ',nis',
            'nama' => 'required|max:100',
            'kelas' => 'required|max:30',
            'tanggal_mulai_pkl' => 'required|date',
            'tanggal_selesai_pkl' => 'required|date|after_or_equal:tanggal_mulai_pkl',
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'kompetensi_id' => 'required|exists:kompetensis,id',
            'skill_ids' => 'nullable|array',
            'skill_ids.*' => 'exists:skills,id',
        ]);

        $siswa->update($validated);

        // Sinkronkan relasi skill setelah update data siswa
        $siswa->skills()->sync($request->skill_ids ?? []);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    /**
     * DESTROY — Hapus siswa
     * =====================
     * Cari by NIS → hapus dari database.
     */
    public function destroy($nis)
    {
        $siswa = Siswa::where('nis', $nis)->firstOrFail();
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
