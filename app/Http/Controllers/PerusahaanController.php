<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

/**
 * CONTROLLER PERUSAHAAN
 * ======================
 * Mengelola CRUD (Create, Read, Update, Delete) untuk data perusahaan.
 *
 * SETIAP METHOD DI SINI = 1 HALAMAN / AKSI di browser.
 *
 * ROUTE YANG TERHUBUNG (dari routes/web.php):
 *   GET    /perusahaan           → index()   (lihat semua)
 *   GET    /perusahaan/create    → create()  (form tambah)
 *   POST   /perusahaan           → store()   (simpan data baru)
 *   GET    /perusahaan/{id}      → show()    (lihat detail)
 *   GET    /perusahaan/{id}/edit → edit()    (form edit)
 *   PUT    /perusahaan/{id}      → update()  (simpan perubahan)
 *   DELETE /perusahaan/{id}      → destroy() (hapus data)
 */
class PerusahaanController extends Controller
{
    /**
     * INDEX — Halaman daftar semua perusahaan
     * =========================================
     * withCount('siswa') = hitung jumlah siswa per perusahaan
     * Hasilnya: $perusahaan->siswa_count (otomatis ditambahkan Laravel)
     *
     * Contoh output: PT Sinergi (40 kuota, 3 siswa terdaftar)
     */
    public function index()
    {
        $perusahaanList = Perusahaan::withCount('siswa')->get();

        return view('perusahaan.index', compact('perusahaanList'));
    }

    /**
     * CREATE — Tampilkan form kosong untuk tambah perusahaan
     * ======================================================
     * Tidak perlu kirim data apa-apa ke view.
     * View hanya menampilkan form input kosong.
     */
    public function create()
    {
        return view('perusahaan.create');
    }

    /**
     * STORE — Simpan data perusahaan baru ke database
     * ================================================
     * $request->validate() = validasi data sebelum disimpan.
     * Kalau validasi gagal, Laravel otomatis redirect balik ke form + tampilkan error.
     *
     * Aturan validasi:
     *   'required'       = wajib diisi
     *   'max:100'        = maksimal 100 karakter
     *   'nullable'       = boleh kosong
     *   'integer'        = harus angka bulat
     *   'min:1'          = minimal angka 1
     *
     * Perusahaan::create($validated) = insert ke database sekaligus
     * Hanya kolom yang ada di $fillable model yang akan disimpan.
     *
     * redirect()->route(...)->with('success', ...) = redirect + kirim flash message
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|max:100',
            'bidang_usaha' => 'required|max:100',
            'alamat' => 'required',
            'nama_pembimbing_industri' => 'nullable|max:100',
            'telepon' => 'nullable|max:20',
            'kuota' => 'required|integer|min:1',
        ]);

        Perusahaan::create($validated);

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil ditambahkan.');
    }

    /**
     * SHOW — Tampilkan detail 1 perusahaan
     * ======================================
     * withCount('siswa') = hitung jumlah siswa
     * with('siswa')      = ambil semua data siswa juga (eager loading)
     * findOrFail($id)    = cari by ID, kalau tidak ada → otomatis error 404
     */
    public function show($id)
    {
        $perusahaan = Perusahaan::withCount('siswa')->with('siswa')->findOrFail($id);

        return view('perusahaan.show', compact('perusahaan'));
    }

    /**
     * EDIT — Tampilkan form edit dengan data lama
     * =============================================
     * Kirim data perusahaan yang sudah ada ke view,
     * supaya form terisi otomatis dengan data lama (old data).
     */
    public function edit($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);

        return view('perusahaan.edit', compact('perusahaan'));
    }

    /**
     * UPDATE — Simpan perubahan data perusahaan
     * ==========================================
     * Sama seperti store(), tapi pakai $perusahaan->update()
     * bukan Perusahaan::create().
     *
     * findOrFail() = kalau ID tidak ditemukan, langsung error 404.
     */
    public function update(Request $request, $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);

        $validated = $request->validate([
            'nama_perusahaan' => 'required|max:100',
            'bidang_usaha' => 'required|max:100',
            'alamat' => 'required',
            'nama_pembimbing_industri' => 'nullable|max:100',
            'telepon' => 'nullable|max:20',
            'kuota' => 'required|integer|min:1',
        ]);

        $perusahaan->update($validated);

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil diperbarui.');
    }

    /**
     * DESTROY — Hapus perusahaan dari database
     * =========================================
     * $perusahaan->delete() = hapus baris dari tabel.
     *
     * Catatan: Karena FK di tabel siswas pakai onDelete('cascade'),
     * semua siswa yang terkait perusahaan ini juga ikut terhapus otomatis.
     */
    public function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->delete();

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil dihapus.');
    }
}
