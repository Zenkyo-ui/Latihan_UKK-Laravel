<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- TITLE: Ambil dari @section('title') di child view --}}
    {{-- Kalau child view tidak define title, pakai default "Sistem E-PKL" --}}
    <title>@yield('title', 'Sistem E-PKL')</title>

    <style>
        /*
         * CSS VARIABLES
         * ==============
         * Tempat menyimpan warna, shadow, radius yang dipakai di seluruh app.
         * Cara pakai: var(--primary) → #0ea5e9
         * Ganti warna di sini → otomatis berubah di semua halaman.
         */
        :root {
            --primary: #0ea5e9;          /* Warna utama (biru) */
            --primary-dark: #0284c7;     /* Biru lebih gelap (untuk hover) */
            --primary-light: #e0f2fe;    /* Biru sangat muda (untuk background ringan) */
            --success: #10b981;          /* Hijau (untuk badge sukses) */
            --success-light: #d1fae5;
            --danger: #ef4444;           /* Merah (untuk badge error/hapus) */
            --danger-light: #fee2e2;
            --warning: #f59e0b;          /* Kuning (untuk badge warning) */
            --warning-light: #fef3c7;
            --gray-50: #f9fafb;          /* Abu-abu paling muda (background body) */
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;         /* Abu-abu paling gelap (navbar) */
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow: 0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.07), 0 2px 4px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1), 0 4px 6px rgba(0,0,0,0.05);
            --radius: 8px;               /* Border radius kecil */
            --radius-lg: 12px;           /* Border radius besar */
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: var(--gray-50); color: var(--gray-800); line-height: 1.6; }

        /*
         * NAVBAR
         * ======
         * position: sticky = navbar tetap di atas saat scroll
         * z-index: 100 = navbar selalu di depan elemen lain
         */
        nav { background: var(--gray-900); padding: 0 24px; height: 64px; display: flex; align-items: center; gap: 32px; box-shadow: var(--shadow-md); position: sticky; top: 0; z-index: 100; }
        .brand { color: white; font-weight: 700; font-size: 1.1rem; display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-icon { width: 36px; height: 36px; background: var(--primary); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.9rem; }
        .nav-links { display: flex; gap: 4px; list-style: none; margin-left: auto; }
        .nav-links a { color: var(--gray-400); text-decoration: none; padding: 8px 16px; border-radius: var(--radius); font-weight: 500; font-size: 0.9rem; transition: all 0.2s; }
        .nav-links a:hover { color: white; background: var(--gray-800); }
        .nav-links a.active { color: white; background: var(--primary); }  /* Halaman aktif = biru */
        .nav-toggle { display: none; background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; padding: 8px; }

        /* MAIN CONTENT */
        main { padding: 32px 24px; max-width: 1200px; margin: 0 auto; }  /* max-width 1200px = konten tidak terlalu lebar */
        .page-header { margin-bottom: 24px; }
        h1 { font-size: 1.5rem; font-weight: 700; color: var(--gray-900); }
        .subtitle { color: var(--gray-500); font-size: 0.9rem; margin-top: 4px; }

        /* CARDS — kotak putih dengan shadow */
        .card { background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow); overflow: hidden; }
        .card-header { padding: 20px 24px; border-bottom: 1px solid var(--gray-200); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
        .card-body { padding: 24px; }

        /* TABLE */
        table { width: 100%; border-collapse: collapse; }  /* border-collapse = gabung border jadi 1 */
        th { text-align: left; padding: 12px 16px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--gray-500); background: var(--gray-50); border-bottom: 1px solid var(--gray-200); }
        td { padding: 14px 16px; border-bottom: 1px solid var(--gray-100); font-size: 0.9rem; }
        tr:last-child td { border-bottom: none; }  /* Baris terakhir tanpa border bawah */
        tr:hover td { background: var(--gray-50); }  /* Hover effect */
        td strong { color: var(--gray-900); font-weight: 600; }

        /* SEARCH BOX */
        .search-box { position: relative; }
        .search-box input { width: 100%; max-width: 320px; padding: 10px 12px 10px 36px; border: 1px solid var(--gray-300); border-radius: var(--radius); font-size: 0.9rem; transition: all 0.2s; }
        .search-box input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-light); }
        .search-box svg { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--gray-400); width: 16px; height: 16px; }

        /* BADGES — label kecil berwarna (contoh: "Penuh", "PPLG") */
        .badge { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
        .badge-success { background: var(--success-light); color: var(--success); }  /* Hijau */
        .badge-danger { background: var(--danger-light); color: var(--danger); }      /* Merah */
        .badge-warning { background: var(--warning-light); color: var(--warning); }   /* Kuning */

        /* BUTTONS */
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px; border: none; border-radius: var(--radius); font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: all 0.2s; text-decoration: none; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-secondary { background: var(--gray-200); color: var(--gray-700); }
        .btn-secondary:hover { background: var(--gray-300); }
        .btn-ghost { background: transparent; color: var(--gray-600); border: 1px solid var(--gray-300); }
        .btn-ghost:hover { background: var(--gray-100); }

        /* STATS GRID — kotak angka di dashboard */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: white; border-radius: var(--radius-lg); padding: 20px; box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); }
        .stat-label { font-size: 0.8rem; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 500; }
        .stat-value { font-size: 1.75rem; font-weight: 700; color: var(--gray-900); margin-top: 4px; }

        /* HOME CARDS — kartu shortcut di dashboard */
        .home-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
        .home-card { background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow); padding: 24px; display: flex; flex-direction: column; gap: 12px; border: 1px solid var(--gray-200); transition: all 0.2s; text-decoration: none; color: inherit; }
        .home-card:hover { box-shadow: var(--shadow-lg); border-color: var(--primary); transform: translateY(-2px); }
        .home-card-icon { width: 48px; height: 48px; background: var(--primary-light); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .home-card h2 { font-size: 1.1rem; color: var(--gray-900); }
        .home-card p { color: var(--gray-500); font-size: 0.9rem; }

        /* DETAIL GRID — tampilan detail data */
        .detail-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-bottom: 24px; }
        .detail-item { background: var(--gray-50); border-radius: var(--radius); padding: 16px; }
        .detail-item dt { font-size: 0.75rem; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; margin-bottom: 4px; }
        .detail-item dd { font-size: 1rem; color: var(--gray-800); font-weight: 500; }

        /* EMPTY STATE — tampilan kalau tidak ada data */
        .empty-state { text-align: center; padding: 48px 24px; color: var(--gray-400); }
        .empty-state p { font-size: 0.9rem; }

        /* FORM */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }  /* 2 kolom */
        .form-group { margin-bottom: 16px; }
        .form-group.full { grid-column: 1 / -1; }  /* Full width = 1 kolom penuh */
        .form-group label { display: block; font-size: 0.8rem; font-weight: 600; color: var(--gray-600); margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.03em; }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%; padding: 10px 12px; border: 1px solid var(--gray-300); border-radius: var(--radius);
            font-size: 0.9rem; transition: all 0.2s; background: white;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-light);
        }
        .form-group .error { color: var(--danger); font-size: 0.8rem; margin-top: 4px; }  /* Error validasi */
        .form-group input.is-invalid, .form-group select.is-invalid { border-color: var(--danger); }
        .form-actions { display: flex; gap: 12px; margin-top: 24px; }

        /* ALERT — notifikasi sukses */
        .alert { padding: 12px 16px; border-radius: var(--radius); margin-bottom: 20px; font-size: 0.9rem; font-weight: 500; }
        .alert-success { background: var(--success-light); color: var(--success); border: 1px solid #a7f3d0; }

        /* DELETE BUTTON */
        .btn-delete { background: none; border: none; color: var(--danger); cursor: pointer; font-size: 0.8rem; font-weight: 500; padding: 6px 12px; border-radius: var(--radius); transition: all 0.2s; }
        .btn-delete:hover { background: var(--danger-light); }

        /* FOOTER */
        footer { margin-top: 48px; padding: 20px 24px; border-top: 1px solid var(--gray-200); color: var(--gray-400); text-align: center; font-size: 0.8rem; }

        /*
         * RESPONSIVE
         * ===========
         * @media (max-width: 768px) = kalau lebar layar <= 768px (HP/tablet)
         * - Navbar: hamburger menu (nav-links tersembunyi, nav-toggle muncul)
         * - Table: padding lebih kecil
         * - Form: 1 kolom
         */
        @media (max-width: 768px) {
            nav { padding: 0 16px; gap: 16px; }
            .nav-links { display: none; position: absolute; top: 64px; left: 0; right: 0; background: var(--gray-900); flex-direction: column; padding: 8px; gap: 2px; }
            .nav-links.open { display: flex; }  /* Toggle class 'open' untuk buka/tutup menu */
            .nav-toggle { display: block; }      /* Tampilkan tombol hamburger */
            main { padding: 20px 16px; }
            .card-header { flex-direction: column; align-items: stretch; }
            .search-box input { max-width: 100%; }
            th, td { padding: 10px 8px; font-size: 0.85rem; }
        }
    </style>
</head>
<body>

    {{-- INCLUDE PARTIALS --}}
    {{-- @include = "salin isi file lain ke sini" --}}
    {{-- Navbar dan footer dipisah supaya tidak duplikat di setiap halaman --}}
    @include('partials.navbar')

    {{-- @yield('content') = "isi ini dengan konten dari child view" --}}
    {{-- Setiap halaman (index, show, create, edit) akan isi bagian ini --}}
    <main>@yield('content')</main>

    @include('partials.footer')

    <script>
        /*
         * HAMBURGER MENU
         * ================
         * Toggle class 'open' pada nav-links saat tombol hamburger diklik.
         * Class 'open' = tampilkan menu (lihat CSS: .nav-links.open { display: flex })
         */
        document.getElementById('navToggle')?.addEventListener('click', () => {
            document.getElementById('navLinks').classList.toggle('open');
        });

        /*
         * SEARCH / FILTER TABLE
         * =======================
         * Fungsi untuk filter baris tabel berdasarkan keyword pencarian.
         *
         * Cara kerja:
         * 1. User ketik di input search
         * 2. Ambil semua baris tbody
         * 3. Bandingkan text setiap baris dengan keyword
         * 4. Sembunyikan baris yang tidak cocok (display: none)
         *
         * Dipakai untuk: cariPerusahaan, cariSiswa, cariKompetensi
         */
        function setupSearch(inputId, tableId) {
            const input = document.getElementById(inputId);
            const table = document.getElementById(tableId);
            if (!input || !table) return;
            input.addEventListener('input', () => {
                const kw = input.value.toLowerCase();
                table.querySelectorAll('tbody tr').forEach(row => {
                    row.style.display = row.textContent.toLowerCase().includes(kw) ? '' : 'none';
                });
            });
        }
        setupSearch('cariPerusahaan', 'tabelPerusahaan');
        setupSearch('cariSiswa', 'tabelSiswa');
        setupSearch('cariKompetensi', 'tabelKompetensi');

        /*
         * SORTING TABLE
         * ===============
         * Klik header kolom → sort baris A-Z atau Z-A.
         *
         * Cara kerja:
         * 1. Cari semua <th> yang punya atribut data-sort
         * 2. Saat diklik, ambil semua baris
         * 3. Sort berdasarkan text di kolom yang sesuai
         * 4. Toggle ascending/descending
         *
         * Contoh: <th data-sort="nama"> → klik → sort berdasarkan kolom nama
         */
        document.querySelectorAll('th[data-sort]').forEach(th => {
            th.addEventListener('click', function() {
                const table = this.closest('table');
                const key = this.dataset.sort;      // "nama", "nis", "kelas"
                const tbody = table.querySelector('tbody');
                const rows = Array.from(tbody.querySelectorAll('tr'));
                const asc = !this.classList.contains('sort-asc');  // Toggle arah sort

                // Hapus class sort dari semua kolom
                table.querySelectorAll('th').forEach(h => h.classList.remove('sort-asc', 'sort-desc'));

                // Tambahkan class sort ke kolom yang diklik
                this.classList.add(asc ? 'sort-asc' : 'sort-desc');

                // Sort baris
                rows.sort((a, b) => {
                    const aVal = a.querySelector(`[data-${key}]`)?.textContent.trim() || '';
                    const bVal = b.querySelector(`[data-${key}]`)?.textContent.trim() || '';
                    return asc ? aVal.localeCompare(bVal) : bVal.localeCompare(aVal);
                });

                // Masukkan baris yang sudah di-sort kembali ke tbody
                rows.forEach(r => tbody.appendChild(r));
            });
        });
    </script>

    {{-- @stack('scripts') = tempat child view menambah script tambahan --}}
    {{-- Contoh: home.blade.php pakai @push('scripts') untuk animasi counter --}}
    @stack('scripts')
</body>
</html>
