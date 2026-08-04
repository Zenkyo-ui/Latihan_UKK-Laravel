<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
 {
 return 'Menampilkan daftar perusahaan mitra PKL dari controller';
 }
 public function show($id)
 {
 return 'Menampilkan detail perusahaan dengan ID: ' . $id;
 }
}
