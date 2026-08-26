<nav>
    <a href="{{ route('home') }}" class="brand">
        <span class="brand-icon">E</span>
        E-PKL RPL
    </a>
    <ul class="nav-links" id="navLinks">
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
        <li><a href="{{ route('siswa.index') }}" class="{{ request()->routeIs('siswa.*') ? 'active' : '' }}">Siswa</a></li>
        <li><a href="{{ route('perusahaan.index') }}" class="{{ request()->routeIs('perusahaan.*') ? 'active' : '' }}">Perusahaan</a></li>
        <li><a href="{{ route('kompetensi.index') }}" class="{{ request()->routeIs('kompetensi.*') ? 'active' : '' }}">Kompetensi</a></li>
    </ul>
    <button class="nav-toggle" id="navToggle" aria-label="Menu">☰</button>
</nav>
