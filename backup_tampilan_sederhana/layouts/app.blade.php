<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistem E-PKL')</title>
</head>
<body>
    <nav>
        <strong>Sistem Informasi PKL — SMK</strong>
        <a href="{{ route('siswa.index') }}">Data Siswa</a>
        <a href="{{ route('perusahaan.index') }}">Data Perusahaan</a>
    </nav>
    <main>
        @yield('content')
    </main>
    <footer>&copy; {{ date('Y') }} SMK — Modul E-PKL</footer>
</body>
</html>
