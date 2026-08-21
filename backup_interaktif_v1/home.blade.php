@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <h1>Selamat Datang di Sistem E-PKL</h1>
    <p class="subjudul">Sistem Informasi Praktik Kerja Lapangan SMK. Pilih salah satu menu di bawah untuk mulai.</p>

    <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px;">
        <div class="kartu" style="flex: 1; min-width: 250px;">
            <h2>Data Siswa</h2>
            <p>Lihat daftar siswa yang sedang melaksanakan PKL di perusahaan mitra.</p>
            <a href="{{ route('siswa.index') }}" class="btn btn-primary">Buka Data Siswa &raquo;</a>
        </div>

        <div class="kartu" style="flex: 1; min-width: 250px;">
            <h2>Data Perusahaan</h2>
            <p>Lihat daftar perusahaan mitra yang bekerja sama dengan sekolah.</p>
            <a href="{{ route('perusahaan.index') }}" class="btn btn-primary">Buka Data Perusahaan &raquo;</a>
        </div>
    </div>
@endsection
