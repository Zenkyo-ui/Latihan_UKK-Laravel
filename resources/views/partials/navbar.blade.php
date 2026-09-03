{{-- PARTIAL: NAVBAR --}}
{{-- ================ --}}
{{-- File ini berisi kode navbar yang DIPECAH dari layout utama --}}
{{-- supaya tidak duplikat di setiap halaman --}}

{{-- @include('partials.navbar') = "salin isi file ini ke layout" --}}
<nav>
    {{-- Logo + nama aplikasi --}}
    <a href="{{ route('home') }}" class="brand">
        <span class="brand-icon">E</span>
        E-PKL PPLG
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

    {{-- Tombol hamburger untuk mobile --}}
    <button class="nav-toggle" id="navToggle" aria-label="Menu">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </button>
</nav>
