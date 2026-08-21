<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\perusahaan;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswaList = siswa::with('perusahaan')->get();

        return view('siswa.index', compact('siswaList'));
    }

    public function create()
    {
        $perusahaanList = perusahaan::withCount('siswa')->get();

        return view('siswa.create', compact('perusahaanList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|max:20|unique:siswas,nis',
            'nama' => 'required|max:100',
            'kelas' => 'required|max:30',
            'tanggal_mulai_pkl' => 'required|date',
            'tanggal_selesai_pkl' => 'required|date|after_or_equal:tanggal_mulai_pkl',
            'perusahaan_id' => 'required|exists:perusahaans,id',
        ]);

        siswa::create($validated);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function show($nis)
    {
        $siswa = siswa::with('perusahaan')->where('nis', $nis)->firstOrFail();

        return view('siswa.show', compact('siswa'));
    }

    public function edit($nis)
    {
        $siswa = siswa::where('nis', $nis)->firstOrFail();
        $perusahaanList = perusahaan::all();

        return view('siswa.edit', compact('siswa', 'perusahaanList'));
    }

    public function update(Request $request, $nis)
    {
        $siswa = siswa::where('nis', $nis)->firstOrFail();

        $validated = $request->validate([
            'nis' => 'required|max:20|unique:siswas,nis,' . $siswa->nis . ',nis',
            'nama' => 'required|max:100',
            'kelas' => 'required|max:30',
            'tanggal_mulai_pkl' => 'required|date',
            'tanggal_selesai_pkl' => 'required|date|after_or_equal:tanggal_mulai_pkl',
            'perusahaan_id' => 'required|exists:perusahaans,id',
        ]);

        $siswa->update($validated);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy($nis)
    {
        $siswa = siswa::where('nis', $nis)->firstOrFail();
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
