<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem E-PKL')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f6f8; color: #333; }

        /* NAVBAR */
        nav { background: #2c3e50; padding: 12px 25px; display: flex; align-items: center; gap: 25px; flex-wrap: wrap; }
        nav .brand { color: white; font-weight: bold; font-size: 1.1em; }
        nav a { color: #cfd8dc; text-decoration: none; padding: 6px 12px; border-radius: 4px; transition: all .2s; }
        nav a:hover { color: white; background: #3d566e; }
        nav a.aktif-nav { color: white; background: #1abc9c; }

        /* LAYOUT */
        main { padding: 25px; max-width: 1100px; margin: 0 auto; }
        h1 { margin-bottom: 8px; color: #2c3e50; }
        .subjudul { color: #777; margin-bottom: 20px; }
        footer { margin-top: 30px; padding: 15px; background: #2c3e50; color: #cfd8dc; text-align: center; }

        /* TOMBOL */
        .btn { display: inline-block; padding: 8px 16px; border: none; border-radius: 5px; text-decoration: none;
               font-size: 14px; cursor: pointer; transition: all .2s; }
        .btn-primary { background: #1abc9c; color: white; }
        .btn-primary:hover { background: #16a085; }
        .btn-secondary { background: #7f8c8d; color: white; }
        .btn-secondary:hover { background: #6b7c7d; }
        .btn-sm { padding: 5px 12px; font-size: 13px; }

        /* KOTAK CARI */
        .cari { padding: 8px 12px; width: 280px; max-width: 100%; border: 1px solid #ccc; border-radius: 5px; }

        /* TABEL */
        .toolbar { display: flex; justify-content: space-between; align-items: center; gap: 15px; flex-wrap: wrap; margin-bottom: 15px; }
        table { border-collapse: collapse; width: 100%; background: white; box-shadow: 0 2px 6px rgba(0,0,0,0.08); }
        table th, table td { border: 1px solid #e0e0e0; padding: 10px; text-align: left; }
        table th { background: #34495e; color: white; }
        table tr:nth-child(even) { background: #f9f9f9; }
        table tr:hover { background: #eef5f3; }
        .kosong { text-align: center; color: #999; padding: 20px !important; }

        /* KARTU HOME */
        .kartu { background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                 transition: transform .2s; }
        .kartu:hover { transform: translateY(-4px); }
        .kartu h2 { color: #2c3e50; margin-bottom: 8px; }
        .kartu p { color: #666; margin-bottom: 15px; }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav>
        <span class="brand">E-PKL RPL</span>
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'aktif-nav' : '' }}">Home</a>
        <a href="{{ route('siswa.index') }}" class="{{ request()->routeIs('siswa.*') ? 'aktif-nav' : '' }}">Data Siswa</a>
        <a href="{{ route('perusahaan.index') }}" class="{{ request()->routeIs('perusahaan.*') ? 'aktif-nav' : '' }}">Data Perusahaan</a>
    </nav>

    {{-- KONTEN --}}
    <main>
        @yield('content')
    </main>

    <footer>&copy; {{ date('Y') }} SMK — Modul E-PKL</footer>

</body>
</html>
