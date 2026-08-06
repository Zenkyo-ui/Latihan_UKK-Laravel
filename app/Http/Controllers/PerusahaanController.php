<?php

namespace App\Http\Controllers;

use App\Models\perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $perusahaanList = perusahaan::all();

        return view('perusahaan.index', compact('perusahaanList'));
    }

    public function show($id)
    {
        $perusahaan = perusahaan::findOrFail($id);

        return view('perusahaan.show', compact('perusahaan'));
    }
}
