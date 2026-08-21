@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="page-header">
        <h1>Dashboard</h1>
        <p class="subtitle">Ringkasan data Sistem Informasi PKL SMK RPL.</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Siswa PKL</div>
            <div class="stat-value">{{ $totalSiswa }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Perusahaan Mitra</div>
            <div class="stat-value">{{ $totalPerusahaan }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Sedang PKL</div>
            <div class="stat-value">{{ $siswaAktif }}</div>
        </div>
    </div>

    <div class="home-grid">
        <a href="{{ route('siswa.index') }}" class="home-card">
            <div class="home-card-icon">👨‍🎓</div>
            <h2>Data Siswa</h2>
            <p>Lihat daftar siswa yang melaksanakan PKL, lengkap dengan data perusahaan dan jadwal.</p>
        </a>

        <a href="{{ route('perusahaan.index') }}" class="home-card">
            <div class="home-card-icon">🏢</div>
            <h2>Data Perusahaan</h2>
            <p>Daftar perusahaan mitra beserta kuota, alamat, dan data kontak pembimbing industri.</p>
        </a>
    </div>
@endsection
