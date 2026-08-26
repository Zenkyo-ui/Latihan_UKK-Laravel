<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Perusahaan;
use App\Models\Kompetensi;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswaList = Siswa::with('perusahaan', 'kompetensi')->get();

        return view('siswa.index', compact('siswaList'));
    }

    public function create()
    {
        $perusahaanList = Perusahaan::withCount('siswa')->get();
        $kompetensiList = Kompetensi::all();

        return view('siswa.create', compact('perusahaanList', 'kompetensiList'));
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
            'kompetensi_id' => 'required|exists:kompetensis,id',
        ]);

        Siswa::create($validated);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function show($nis)
    {
        $siswa = Siswa::with('perusahaan', 'kompetensi')->where('nis', $nis)->firstOrFail();

        return view('siswa.show', compact('siswa'));
    }

    public function edit($nis)
    {
        $siswa = Siswa::where('nis', $nis)->firstOrFail();
        $perusahaanList = Perusahaan::all();
        $kompetensiList = Kompetensi::all();

        return view('siswa.edit', compact('siswa', 'perusahaanList', 'kompetensiList'));
    }

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
        ]);

        $siswa->update($validated);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy($nis)
    {
        $siswa = Siswa::where('nis', $nis)->firstOrFail();
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
