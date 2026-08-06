<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswaList = siswa::with('perusahaan')->get();

        return view('siswa.index', compact('siswaList'));
    }

    public function show($nis)
    {
        $siswa = siswa::with('perusahaan')->where('nis', $nis)->firstOrFail();

        return view('siswa.show', compact('siswa'));
    }
}
