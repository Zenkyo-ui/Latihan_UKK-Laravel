<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- TITLE: Ambil dari @section('title') di child view --}}
    {{-- Kalau child view tidak define title, pakai default "Sistem E-PKL" --}}
    <title>@yield('title', 'Sistem E-PKL')</title>

    {{-- FONT: Almarai (sans, khas Hirael) + Instrument Serif (italic aksen) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">

    <style>
        /*
         * CSS VARIABLES
         * ==============
         * Tempat menyimpan warna, shadow, radius yang dipakai di seluruh app.
         * Cara pakai: var(--primary) → #0ea5e9
         * Ganti warna di sini → otomatis berubah di semua halaman.
         */
        :root {
            /* AKSEN HIAREL: bronze/warm di atas hitam hangat */
            --primary: #c4a278;          /* Bronze hangat (aksi utama) */
            --primary-dark: #a88a63;     /* Bronze lebih gelap (hover) */
            --primary-light: #3a3229;    /* Bronze muda samar (background ringan) */
            --success: #86b98a;          /* Hijau hangat lembut */
            --success-light: #223026;
            --danger: #e08a86;           /* Merah hangat lembut */
            --danger-light: #3a2422;
            --warning: #d9b26e;          /* Kuning hangat */
            --warning-light: #3a3229;

            /* RAMBU WARNA HIAREL (dark/warm) */
            --cs-cream: #e1e0cc;         /* Teks utama krem */
            --cs-ink: #dedbc8;           /* Teks sekunder */
            --cs-muted: #8b8a80;         /* Teks muted/abu */
            --cs-surface: #101010;       /* Kartu gelap */
            --cs-surface-2: #212121;     /* Kartu lebih gelap */
            --cs-bg: #070707;            /* Latar paling gelap */

            --gray-50: #1b1b19;          /* Background body gelap hangat */
            --gray-100: #232320;         /* Hover baris / surface ringan */
            --gray-200: #2c2c29;         /* Border & secondary btn */
            --gray-300: #3a3a35;         /* Border input */
            --gray-400: #6b6a60;         /* Icon & placeholder */
            --gray-500: #8b8a80;         /* Muted text */
            --gray-600: #b6b4a8;         /* Label form */
            --gray-700: #c9c7ba;         /* Text sekunder */
            --gray-800: #e1e0cc;         /* Teks utama (krem) */
            --gray-900: #111110;         /* Navbar paling gelap */
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.4);
            --shadow: 0 1px 3px rgba(0,0,0,0.5), 0 1px 2px rgba(0,0,0,0.4);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.5), 0 2px 4px rgba(0,0,0,0.4);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.5), 0 4px 6px rgba(0,0,0,0.4);
            --radius: 12px;              /* Border radius besar (feel hirael) */
            --radius-lg: 22px;           /* Border radius card */

            /*
             * VARIABEL TEMA GELAP (DEFAULT — gaya HIAREL)
             * ===========================================
             * Pakai var(--bg), var(--bg-card), dll di seluruh komponen
             * supaya ganti tema jadi mudah.
             */
            --bg: var(--cs-bg);              /* Background halaman */
            --bg-card: var(--cs-surface);    /* Background card */
            --bg-input: #1a1a18;             /* Background input */
            --bg-nav: var(--cs-bg);          /* Background navbar */
            --bg-table-head: var(--cs-surface-2); /* Background header tabel */
            --bg-detail: #1a1a18;            /* Background kotak detail */
            --text: var(--cs-ink);           /* Warna teks utama */
            --text-strong: var(--cs-cream);  /* Teks tebal (judul, nama) */
            --text-muted: var(--cs-muted);   /* Teks abu (subtitle, label) */
            --text-nav: var(--cs-muted);     /* Warna link navbar */
            --text-nav-hover: var(--cs-cream); /* Warna link navbar hover */
            --border: #2c2c29;               /* Border table/card */
            --border-input: #3a3a35;         /* Border input */
            --badge-bg: transparent;
            --shadow-card: var(--shadow);
            --bg-nav-hover: #232320;         /* Background link navbar hover */
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Almarai', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: var(--bg); color: var(--text); line-height: 1.6; }

        /* HEADING SERIF — aksen ala Hirael (Instrument Serif italic) */
        h1, .page-header h1 { font-family: 'Instrument Serif', serif; font-style: italic; font-weight: 400; letter-spacing: 0.01em; color: var(--text-strong); }
        .stat-value, .home-card h2 { font-family: 'Instrument Serif', serif; font-weight: 400; }

        /*
         * NAVBAR
         * ======
         * position: sticky = navbar tetap di atas saat scroll
         * z-index: 100 = navbar selalu di depan elemen lain
         */
        nav { background: var(--bg-nav); padding: 0 24px; height: 64px; display: flex; align-items: center; gap: 20px; box-shadow: var(--shadow-md); position: sticky; top: 0; z-index: 100; }
        .brand { color: var(--cs-cream); font-weight: 700; font-size: 1.1rem; display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-icon { width: 36px; height: 36px; background: var(--primary); color: #0a0a08; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.9rem; }
        .nav-links { display: flex; gap: 4px; list-style: none; margin-left: auto; }
        .nav-links a { color: var(--text-nav); text-decoration: none; padding: 8px 16px; border-radius: var(--radius); font-weight: 500; font-size: 0.9rem; transition: all 0.2s; }
        .nav-links a:hover { color: var(--text-nav-hover); background: var(--bg-nav-hover); }
        .nav-links a.active { color: #0a0a08; background: var(--primary); }  /* Halaman aktif = bronze */
        .nav-toggle { display: none; background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; padding: 8px; }

        /* MAIN CONTENT */
        main { padding: 32px 24px; max-width: 1200px; margin: 0 auto; }  /* max-width 1200px = konten tidak terlalu lebar */
        .page-header { margin-bottom: 24px; }
        h1 { font-size: 1.5rem; font-weight: 700; color: var(--text-strong); }
        .subtitle { color: var(--text-muted); font-size: 0.9rem; margin-top: 4px; }

        /* CARDS — kotak putih dengan shadow */
        .card { background: var(--bg-card); border-radius: var(--radius-lg); box-shadow: var(--shadow-card); overflow: hidden; }
        .card-header { padding: 20px 24px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
        .card-body { padding: 24px; }

        /* TABLE */
        table { width: 100%; border-collapse: collapse; }  /* border-collapse = gabung border jadi 1 */
        th { text-align: left; padding: 12px 16px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--gray-500); background: var(--bg-table-head); border-bottom: 1px solid var(--border); }
        td { padding: 14px 16px; border-bottom: 1px solid var(--border); font-size: 0.9rem; }
        tr:last-child td { border-bottom: none; }  /* Baris terakhir tanpa border bawah */
        tr:hover td { background: var(--gray-100); }  /* Hover effect */
        td strong { color: var(--text-strong); font-weight: 600; }

        /* SEARCH BOX */
        .search-box { position: relative; }
        .search-box input { width: 100%; max-width: 320px; padding: 10px 12px 10px 36px; border: 1px solid var(--border-input); border-radius: var(--radius); font-size: 0.9rem; transition: all 0.2s; background: var(--bg-input); color: var(--text); }
        .search-box input::placeholder { color: var(--gray-400); }
        .search-box input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px var(--primary-light); }
        .search-box svg { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--gray-400); width: 16px; height: 16px; }

        /* BADGES — label kecil berwarna (contoh: "Penuh", "PPLG") */
        .badge { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
        .badge-success { background: var(--success-light); color: var(--success); }  /* Hijau */
        .badge-danger { background: var(--danger-light); color: var(--danger); }      /* Merah */
        .badge-warning { background: var(--warning-light); color: var(--warning); }   /* Kuning */

        /* BUTTONS — bentuk pill (rounded-full) ala Hirael */
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 10px 20px; border: none; border-radius: 9999px; font-size: 0.875rem; font-weight: 700; cursor: pointer; transition: all 0.2s; text-decoration: none; }
        .btn-primary { background: var(--primary); color: #0a0a08; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-secondary { background: var(--gray-300); color: var(--gray-800); }
        .btn-secondary:hover { background: var(--gray-400); }
        .btn-ghost { background: transparent; color: var(--cs-ink); border: 1px solid var(--border-input); }
        .btn-ghost:hover { background: var(--gray-100); }
        .btn-danger { background: var(--danger-light); color: var(--danger); }
        .btn-danger:hover { background: var(--danger); color: #1a1a18; }

        /* STATS GRID — kotak angka di dashboard */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: var(--bg-card); border-radius: var(--radius-lg); padding: 20px; box-shadow: var(--shadow-card); border: 1px solid var(--border); }
        .stat-label { font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 500; }
        .stat-value { font-size: 1.75rem; font-weight: 700; color: var(--text-strong); margin-top: 4px; }

        /* HOME CARDS — kartu shortcut di dashboard */
        .home-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; }
        .home-card { background: var(--bg-card); border-radius: var(--radius-lg); box-shadow: var(--shadow-card); padding: 24px; display: flex; flex-direction: column; gap: 12px; border: 1px solid var(--border); transition: all 0.2s; text-decoration: none; color: inherit; }
        .home-card:hover { box-shadow: var(--shadow-lg); border-color: var(--primary); transform: translateY(-2px); }
        .home-card-icon { width: 48px; height: 48px; background: var(--primary-light); color: var(--primary-dark); border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .home-card h2 { font-size: 1.1rem; color: var(--text-strong); }
        .home-card p { color: var(--text-muted); font-size: 0.9rem; }

        /* DETAIL GRID — tampilan detail data */
        .detail-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; margin-bottom: 24px; }
        .detail-item { background: var(--bg-detail); border-radius: var(--radius); padding: 16px; }
        .detail-item dt { font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; margin-bottom: 4px; }
        .detail-item dd { font-size: 1rem; color: var(--text); font-weight: 500; }

        /* EMPTY STATE — tampilan kalau tidak ada data */
        .empty-state { text-align: center; padding: 48px 24px; color: var(--gray-400); }
        .empty-state p { font-size: 0.9rem; }

        /* FORM */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }  /* 2 kolom */
        .form-group { margin-bottom: 16px; }
        .form-group.full { grid-column: 1 / -1; }  /* Full width = 1 kolom penuh */
        .form-group label { display: block; font-size: 0.8rem; font-weight: 600; color: var(--gray-600); margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.03em; }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%; padding: 10px 12px; border: 1px solid var(--border-input); border-radius: var(--radius);
            font-size: 0.9rem; transition: all 0.2s; background: var(--bg-input); color: var(--text);
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
        footer { margin-top: 48px; padding: 20px 24px; border-top: 1px solid var(--border); color: var(--text-muted); text-align: center; font-size: 0.8rem; }

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
            .nav-links { display: none; position: absolute; top: 64px; left: 0; right: 0; background: var(--bg-nav); flex-direction: column; padding: 8px; gap: 2px; }
            .nav-links.open { display: flex; }  /* Toggle class 'open' untuk buka/tutup menu */
            .nav-toggle { display: block; }      /* Tampilkan tombol hamburger */
            main { padding: 20px 16px; }
            .card-header { flex-direction: column; align-items: stretch; }
            .search-box input { max-width: 100%; }
            th, td { padding: 10px 8px; font-size: 0.85rem; }
            .form-grid { grid-template-columns: 1fr; }  /* Form jadi 1 kolom di HP */
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
         * Dipakai untuk: cariPerusahaan, cariSiswa, cariKompetensi, cariPenilaian
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
        setupSearch('cariPenilaian', 'tabelPenilaian');

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
