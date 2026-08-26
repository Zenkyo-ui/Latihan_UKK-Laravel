<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $perusahaanList = Perusahaan::withCount('siswa')->get();

        return view('perusahaan.index', compact('perusahaanList'));
    }

    public function create()
    {
        return view('perusahaan.create');
    }

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

    public function show($id)
    {
        $perusahaan = Perusahaan::withCount('siswa')->with('siswa')->findOrFail($id);

        return view('perusahaan.show', compact('perusahaan'));
    }

    public function edit($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);

        return view('perusahaan.edit', compact('perusahaan'));
    }

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

    public function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->delete();

        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil dihapus.');
    }
}
