<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\Siswa;
use Illuminate\Http\Request;

/**
 * CONTROLLER PENILAIAN
 * =====================
 * Mengelola CRUD untuk data penilaian PKL siswa di perusahaan.
 * Sama polanya dengan controller lain di project ini.
 *
 * ROUTE (dari routes/web.php):
 *   GET    /penilaian           → index()
 *   GET    /penilaian/create    → create()
 *   POST   /penilaian           → store()
 *   GET    /penilaian/{id}      → show()
 *   GET    /penilaian/{id}/edit → edit()
 *   PUT    /penilaian/{id}      → update()
 *   DELETE /penilaian/{id}      → destroy()
 */
class PenilaianController extends Controller
{
    /**
     * KONSTANTA PILIHAN (FLEKSIBEL)
     * ==============================
     * Semua daftar pilihan status disimpan di SATU tempat (di sini),
     * supaya nanti kalau mau menambah/mengubah kategori tinggal edit bagian
     * ini tanpa perlu migrasi database.
     */

    // Pilihan status penguasaan kompetensi (5 kategori)
    public const STATUS_PENGUASAAN = [
        'Sangat Mahir',
        'Mahir',
        'Cukup',
        'Kurang',
        'Belum Dikuasai',
    ];

    // Pilihan keaktifan / kehadiran (4 kategori)
    public const KEAKTIFAN = [
        'Sangat Baik',
        'Baik',
        'Cukup',
        'Kurang',
    ];

    // Pilihan sikap / attitude (4 kategori)
    public const SIKAP = [
        'Sangat Baik',
        'Baik',
        'Cukup',
        'Kurang',
    ];

    // Pilihan status tamat
    public const STATUS_TAMAT = [
        'Lulus',
        'Tidak Lulus',
    ];

    // Ambang batas lulus (mudah diubah di sini)
    public const NILAI_MIN_LULUS = 70;

    /**
     * Helper: hitung status tamat otomatis dari skor.
     * Dipakai sebagai DEFAULT di form, user tetap bisa ubah manual.
     */
    protected function tentukanStatusTamatOtomatis($skor)
    {
        return $skor >= self::NILAI_MIN_LULUS ? 'Lulus' : 'Tidak Lulus';
    }

    /**
     * INDEX — Daftar semua penilaian
     * with('siswa.perusahaan') = sekalian ambil data siswa + perusahaannya
     * sehingga di view bisa tampil nama siswa & perusahaan tanpa query tambahan.
     */
    public function index()
    {
        $penilaianList = Penilaian::with('siswa.perusahaan')->latest()->get();

        return view('penilaian.index', compact('penilaianList'));
    }

    /**
     * CREATE — Form kosong untuk tambah penilaian
     *
     * $siswaList = daftar siswa yang BELUM punya penilaian (biar tidak dobel).
     * whereDoesntHave('penilaian') = ambil siswa yang belum dinilai.
     *
     * Jika URL pakai ?siswa_id=X (dari tombol input nilai di halaman siswa),
     * siswa itu otomatis ter-pilih di dropdown.
     */
    public function create(Request $request)
    {
        $siswaList = Siswa::whereDoesntHave('penilaian')->with('perusahaan')->get();

        // Siswa yang sudah dipilih lewat query string (?siswa_id=...)
        $selectedSiswaId = $request->query('siswa_id');

        return view('penilaian.create', compact('siswaList', 'selectedSiswaId'));
    }

    /**
     * STORE — Simpan penilaian baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_penilaian'  => 'required|date',
            'siswa_id'           => 'required|exists:siswas,id|unique:penilaians,siswa_id',
            'skor'               => 'required|integer|between:0,100',
            'status_penguasaan'  => 'required|in:' . implode(',', self::STATUS_PENGUASAAN),
            'keaktifan'          => 'required|in:' . implode(',', self::KEAKTIFAN),
            'sikap'              => 'required|in:' . implode(',', self::SIKAP),
            'status_tamat'       => 'required|in:' . implode(',', self::STATUS_TAMAT),
            'catatan'            => 'nullable|max:1000',
        ]);

        Penilaian::create($validated);

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil disimpan.');
    }

    /**
     * SHOW — Detail penilaian 1 siswa
     */
    public function show($id)
    {
        $penilaian = Penilaian::with('siswa.perusahaan')->findOrFail($id);

        return view('penilaian.show', compact('penilaian'));
    }

    /**
     * EDIT — Form edit penilaian
     * Semua siswa diambil (tidak hanya yang belum dinilai),
     * karena siswa penilaian ini di-keep supaya tidak bisa pindah ke siswa lain.
     */
    public function edit($id)
    {
        $penilaian = Penilaian::with('siswa')->findOrFail($id);

        // Siswa yang belum dinilai + siswa pemilik penilaian ini
        $siswaList = Siswa::whereDoesntHave('penilaian')
                        ->orWhere('id', $penilaian->siswa_id)
                        ->with('perusahaan')
                        ->get();

        return view('penilaian.edit', compact('penilaian', 'siswaList'));
    }

    /**
     * UPDATE — Simpan perubahan penilaian
     * Rules 'unique' di-exclude dari ID sendiri supaya tidak bentrok saat edit.
     */
    public function update(Request $request, $id)
    {
        $penilaian = Penilaian::findOrFail($id);

        $validated = $request->validate([
            'tanggal_penilaian'  => 'required|date',
            // unique kecuali untuk penilaian yang sedang diedit ini
            'siswa_id'           => 'required|exists:siswas,id|unique:penilaians,siswa_id,' . $penilaian->id,
            'skor'               => 'required|integer|between:0,100',
            'status_penguasaan'  => 'required|in:' . implode(',', self::STATUS_PENGUASAAN),
            'keaktifan'          => 'required|in:' . implode(',', self::KEAKTIFAN),
            'sikap'              => 'required|in:' . implode(',', self::SIKAP),
            'status_tamat'       => 'required|in:' . implode(',', self::STATUS_TAMAT),
            'catatan'            => 'nullable|max:1000',
        ]);

        $penilaian->update($validated);

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui.');
    }

    /**
     * DESTROY — Hapus penilaian
     */
    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil dihapus.');
    }
}
