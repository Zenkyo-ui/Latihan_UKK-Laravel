<?php

namespace App\Http\Controllers;

use App\Models\Kompetensi;
use Illuminate\Http\Request;

class KompetensiController extends Controller
{
    public function index()
    {
        $kompetensiList = Kompetensi::withCount('siswa')->get();

        return view('kompetensi.index', compact('kompetensiList'));
    }

    public function create()
    {
        return view('kompetensi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kompetensi' => 'required|max:100',
            'deskripsi' => 'nullable|max:500',
        ]);

        Kompetensi::create($validated);

        return redirect()->route('kompetensi.index')->with('success', 'Kompetensi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kompetensi = Kompetensi::withCount('siswa')->with('siswa')->findOrFail($id);

        return view('kompetensi.show', compact('kompetensi'));
    }

    public function edit($id)
    {
        $kompetensi = Kompetensi::findOrFail($id);

        return view('kompetensi.edit', compact('kompetensi'));
    }

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

    public function destroy($id)
    {
        $kompetensi = Kompetensi::findOrFail($id);
        $kompetensi->delete();

        return redirect()->route('kompetensi.index')->with('success', 'Kompetensi berhasil dihapus.');
    }
}
