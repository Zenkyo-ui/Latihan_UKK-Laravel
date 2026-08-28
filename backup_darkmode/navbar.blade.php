{{-- PARTIAL: NAVBAR --}}
{{-- ================ --}}
{{-- File ini berisi kode navbar yang DIPECAH dari layout utama --}}
{{-- supaya tidak duplikat di setiap halaman --}}

{{-- @include('partials.navbar') = "salin isi file ini ke layout" --}}
<nav>
    {{-- Logo + nama aplikasi --}}
    <a href="{{ route('home') }}" class="brand">
        <span class="brand-icon">E</span>
        E-PKL RPL
    </a>

    {{-- Menu navigasi --}}
    <ul class="nav-links" id="navLinks">
        {{-- request()->routeIs('home') = cek apakah route saat ini bernama 'home' --}}
        {{-- Kalau iya → tambah class 'active' → link jadi biru --}}
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
        <li><a href="{{ route('siswa.index') }}" class="{{ request()->routeIs('siswa.*') ? 'active' : '' }}">Siswa</a></li>
        <li><a href="{{ route('perusahaan.index') }}" class="{{ request()->routeIs('perusahaan.*') ? 'active' : '' }}">Perusahaan</a></li>
        <li><a href="{{ route('kompetensi.index') }}" class="{{ request()->routeIs('kompetensi.*') ? 'active' : '' }}">Kompetensi</a></li>
        <li><a href="{{ route('penilaian.index') }}" class="{{ request()->routeIs('penilaian.*') ? 'active' : '' }}">Penilaian</a></li>
    </ul>

    {{-- TOMBOL GANTI TEMA (Dark Mode) --}}
    {{-- Klik → ganti terang/gelap. Logikanya ada di layouts/app.blade.php (JS theme toggle) --}}
    {{-- Ikon ganti otomatis via CSS [data-theme="dark"]: bulan (terang) / matahari (gelap) --}}
    {{-- keduanya pakai stroke="currentColor" → warna ikon ikut warna text tombol --}}
    <button type="button" id="themeToggle" class="theme-toggle" aria-label="Ganti tema">
        {{-- Ikon BULAN (pakai saat tema terang) --}}
        <span class="theme-icon-light">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
        </span>
        {{-- Ikon MATAHARI (pakai saat tema gelap) --}}
        <span class="theme-icon-dark">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="5"></circle>
                <line x1="12" y1="1" x2="12" y2="3"></line>
                <line x1="12" y1="21" x2="12" y2="23"></line>
                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                <line x1="1" y1="12" x2="3" y2="12"></line>
                <line x1="21" y1="12" x2="23" y2="12"></line>
                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
            </svg>
        </span>
    </button>

    {{-- Tombol hamburger untuk mobile --}}
    <button class="nav-toggle" id="navToggle" aria-label="Menu">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </button>
</nav>
