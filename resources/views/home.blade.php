{{-- HOME / DASHBOARD --}}
{{-- ================= --}}
{{-- Halaman utama yang muncul saat user buka domain/ --}}

{{-- @extends('layouts.app') = "Gunakan layout dari layouts/app.blade.php" --}}
{{-- Layout ini menyediakan: navbar, footer, CSS, JavaScript --}}
@extends('layouts.app')

{{-- @section('title', 'Beranda') = isi bagian title di layout --}}
{{-- Hasilnya: <title>Beranda</title> --}}
@section('title', 'Beranda')

{{-- @section('content') ... @endsection = isi bagian content di layout --}}
{{-- Bagian ini akan muncul di <main>@yield('content')</main> --}}
@section('content')
    <div class="page-header">
        <h1>Dashboard</h1>
        <p class="subtitle">Ringkasan data Sistem Informasi PKL SMK RPL.</p>
    </div>

    {{-- STATISTICS CARDS --}}
    {{-- Grid 4 kotak angka: total siswa, perusahaan, aktif, kompetensi --}}
    {{-- {{ $totalSiswa }} = echo variabel dari controller/route --}}
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
        <div class="stat-card">
            <div class="stat-label">Kompetensi IT</div>
            <div class="stat-value">{{ $totalKompetensi }}</div>
        </div>
    </div>

    {{-- SHORTCUT CARDS --}}
    {{-- Kartu-kartu yang mengarah ke halaman lain --}}
    {{-- {{ route('siswa.index') }} = generate URL untuk route 'siswa.index' --}}
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

        <a href="{{ route('kompetensi.index') }}" class="home-card">
            <div class="home-card-icon">💻</div>
            <h2>Kompetensi IT</h2>
            <p>Daftar kompetensi yang dipelajari siswa selama PKL, seperti web, database, jaringan, dan lainnya.</p>
        </a>
    </div>
@endsection
