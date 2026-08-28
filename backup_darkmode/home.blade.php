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
        <div class="stat-card">
            <div class="stat-label">Sudah Dinilai</div>
            <div class="stat-value">{{ $totalPenilaian }}</div>
        </div>
    </div>

    {{-- SHORTCUT CARDS --}}
    {{-- Kartu-kartu yang mengarah ke halaman lain --}}
    {{-- {{ route('siswa.index') }} = generate URL untuk route 'siswa.index' --}}
    <div class="home-grid">
        <a href="{{ route('siswa.index') }}" class="home-card">
            {{-- Ikon siswa (graduation cap) --}}
            <div class="home-card-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 10L12 5L2 10l10 5l10-5z"></path>
                    <path d="M6 12v5c0 1.7 2.7 3 6 3s6-1.3 6-3v-5"></path>
                    <path d="M22 10v6"></path>
                </svg>
            </div>
            <h2>Data Siswa</h2>
            <p>Lihat daftar siswa yang melaksanakan PKL, lengkap dengan data perusahaan dan jadwal.</p>
        </a>

        <a href="{{ route('perusahaan.index') }}" class="home-card">
            {{-- Ikon gedung kantor --}}
            <div class="home-card-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 21h18"></path>
                    <path d="M5 21V7l7-4 7 4v14"></path>
                    <path d="M9 9h1"></path>
                    <path d="M9 13h1"></path>
                    <path d="M9 17h1"></path>
                    <path d="M14 9h1"></path>
                    <path d="M14 13h1"></path>
                    <path d="M14 17h1"></path>
                </svg>
            </div>
            <h2>Data Perusahaan</h2>
            <p>Daftar perusahaan mitra beserta kuota, alamat, dan data kontak pembimbing industri.</p>
        </a>

        <a href="{{ route('kompetensi.index') }}" class="home-card">
            {{-- Ikon komputer / laptop --}}
            <div class="home-card-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="20" height="13" rx="2"></rect>
                    <path d="M2 21h20"></path>
                    <path d="M8 17v4h8v-4"></path>
                </svg>
            </div>
            <h2>Kompetensi IT</h2>
            <p>Daftar kompetensi yang dipelajari siswa selama PKL, seperti web, database, jaringan, dan lainnya.</p>
        </a>

        <a href="{{ route('penilaian.index') }}" class="home-card">
            {{-- Ikon klipboard / penilaian --}}
            <div class="home-card-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                    <rect x="8" y="2" width="8" height="4" rx="1"></rect>
                    <line x1="9" y1="12" x2="15" y2="12"></line>
                    <line x1="9" y1="16" x2="13" y2="16"></line>
                </svg>
            </div>
            <h2>Penilaian PKL</h2>
            <p>Input dan lihat hasil penilaian PKL siswa di perusahaan, meliputi skor, sikap, dan keaktifan.</p>
        </a>
    </div>
@endsection