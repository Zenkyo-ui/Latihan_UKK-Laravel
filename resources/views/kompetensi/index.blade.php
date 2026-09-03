@extends('layouts.app')

@section('title', 'Kompetensi')

@section('content')
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1>Kompetensi (Skill)</h1>
            <p class="subtitle">{{ $kompetensiList->count() }} jurusan dengan skill yang dikelompokkan per jurusan.</p>
        </div>
        <div style="display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">
            <a href="#" id="btnTambahSkill" class="btn btn-primary">+ Tambah Skill</a>
        </div>
    </div>

    @include('partials.alert')

    {{-- KONTAINER TABEL SKILL JURUSAN TERPILIH (diisi AJAX) — tampil saat kartu jurusan diklik --}}
    <div id="skillTableWrap" style="display:none; margin-bottom: 20px;">
        <div class="card">
            <div class="card-header" style="gap: 10px;">
                <strong style="font-size:0.95rem;">Skill untuk Jurusan: <span id="jurusanNama" style="color:var(--primary);"></span></strong>
                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                    <div class="search-box" style="position:relative;" id="searchSkillWrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" id="cariSkill" placeholder="Cari skill...">
                    </div>
                    <button type="button" id="btnTutupSkill" class="btn btn-ghost" style="padding:7px 14px; font-size:0.8rem; line-height:1.2;">Tutup</button>
                </div>
            </div>
            <div style="overflow-x: auto;">
                <table id="tabelKompetensi">
                    <thead>
                        <tr>
                            <th style="width:50px">No</th>
                            <th data-sort="nama">Nama Skill</th>
                            <th>Deskripsi</th>
                            <th>Yang Menguasai</th>
                            <th style="width:180px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="skillTableBody"></tbody>
                </table>
                <p id="skillEmpty" class="empty-state" style="display:none;">Belum ada skill untuk jurusan ini.</p>
            </div>
        </div>
    </div>

    {{-- DAERAH SEMUA JURUSAN — grid kartu. Klik kartu untuk lihat skill jurusan itu. --}}
    <div id="jurusanSekilas">
        <div class="card">
            <div class="card-header">
                <strong style="font-size:0.95rem;">Semua Jurusan</strong>
            </div>
            <div style="padding: 24px;">
                <div class="home-grid">
                    @forelse ($kompetensiList as $k)
                        <button type="button"
                            class="home-card jurusan-card"
                            data-id="{{ $k->id }}"
                            style="text-align:left; width:100%; cursor:pointer; font-family:inherit;">
                            <div class="home-card-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                            </div>
                            <div>
                                <h2 style="font-size:1.1rem; color:var(--text-strong);">{{ $k->nama_kompetensi }}</h2>
                                <p style="color:var(--text-muted); font-size:0.9rem;">{{ $k->skills_count }} skill</p>
                            </div>
                        </button>
                    @empty
                        <p style="color: var(--text-muted);">Belum ada jurusan.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
        let selectedJurusan = null;      // id jurusan yang sedang aktif
        let activeJurusanName = '';      // nama jurusan aktif

        const jurusanSekilas = document.getElementById('jurusanSekilas');
        const skillTableWrap = document.getElementById('skillTableWrap');
        const jurusanNama = document.getElementById('jurusanNama');
        const searchSkillWrap = document.getElementById('searchSkillWrap');

        // Tombol "+ Tambah Skill" di header — bawa jurusan aktif kalau sedang dibuka
        const btnTambah = document.getElementById('btnTambahSkill');
        function updateTambahHref() {
            btnTambah.href = selectedJurusan
                ? `{{ route('kompetensi.create') }}?jurusan=${selectedJurusan}`
                : `{{ route('kompetensi.create') }}`;
        }

        // Tampilkan grid kartu jurusan lagi
        function renderJurusanCards() {
            selectedJurusan = null;
            activeJurusanName = '';
            jurusanSekilas.style.display = '';
            skillTableWrap.style.display = 'none';
            renderBackBtn();
            updateTambahHref();
        }

        // Ganti label tombol "Tutup" jadi "Kembali" saat panel skill terbuka
        function renderBackBtn() {
            const btn = document.getElementById('btnTutupSkill');
            const isOpen = !selectedJurusan;
            btn.textContent = isOpen ? 'Tutup' : 'Kembali';
        }

        // Ambil skill jurusan via AJAX lalu render tabel
        function loadSkills(jurusanId, jurusanName) {
            selectedJurusan = jurusanId;
            activeJurusanName = jurusanName;
            jurusanNama.textContent = jurusanName;
            updateTambahHref();

            jurusanSekilas.style.display = 'none';
            skillTableWrap.style.display = '';

            // Tambahkan entri history supaya tombol Back browser kembali ke grid
            // kartu jurusan di halaman kompetensi yang sama, bukan ke halaman lain.
            history.pushState({ kompetensi: true, jurusanId, jurusanName }, '', `#${jurusanName}`);
            renderBackBtn();

            const tbody = document.getElementById('skillTableBody');
            const empty = document.getElementById('skillEmpty');
            tbody.innerHTML = '<tr><td colspan="5" style="color:var(--text-muted); padding:24px; text-align:center;">Memuat skill...</td></tr>';
            empty.style.display = 'none';

            fetch(`/kompetensi/${jurusanId}/skills`)
                .then(r => r.json())
                .then(skills => {
                    if (!skills.length) {
                        tbody.innerHTML = '';
                        empty.style.display = '';
                        return;
                    }
                    let html = '';
                    skills.forEach((skill, i) => {
                        html += `
                            <tr>
                                <td>${i + 1}</td>
                                <td data-nama="${skill.nama_skill}"><strong>${skill.nama_skill}</strong></td>
                                <td>${skill.deskripsi || '-'}</td>
                                <td><span class="badge badge-success">${skill.siswa_count} siswa</span></td>
                                <td style="display:flex; align-items:center; gap:4px; white-space:nowrap;">
                                    <a href="/kompetensi/${skill.id}" class="btn btn-primary" style="padding:5px 10px; font-size:0.75rem; line-height:1.2;">Detail</a>
                                    <a href="/kompetensi/${skill.id}/edit" class="btn btn-secondary" style="padding:5px 10px; font-size:0.75rem; line-height:1.2;">Edit</a>
                                    <form method="POST" action="/kompetensi/${skill.id}" onsubmit="return confirm('Yakin hapus skill ini?')" style="display:inline-flex; align-items:center;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" style="padding:5px 10px; font-size:0.75rem; line-height:1.2; display:inline-flex; align-items:center; gap:4px;">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>`;
                    });
                    tbody.innerHTML = html;
                    filterSkills();
                })
                .catch(() => {
                    tbody.innerHTML = '<tr><td colspan="5" class="empty-state">Gagal memuat skill. Coba lagi.</td></tr>';
                });
        }

        // Filter skill pada tabel dinamis
        function filterSkills() {
            const input = document.getElementById('cariSkill');
            const table = document.getElementById('tabelKompetensi');
            if (!input || !table) return;
            const kw = input.value.toLowerCase();
            table.querySelectorAll('tbody tr').forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(kw) ? '' : 'none';
            });
        }

        // Klik kartu jurusan -> muat skill jurusan itu
        document.querySelectorAll('.jurusan-card').forEach(card => {
            card.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.querySelector('h2').textContent.trim();
                loadSkills(id, name);
            });
        });

        // Tombol "Tutup"/"Kembali" — kembali ke grid kartu (via history back)
        document.getElementById('btnTutupSkill').addEventListener('click', function () {
            renderJurusanCards();
            history.back();
        });

        // Back/Forward browser — tampilkan grid kartu saat kembali ke entri grid
        window.addEventListener('popstate', function () {
            renderJurusanCards();
        });

        // Input pencarian skill
        document.getElementById('cariSkill').addEventListener('input', filterSkills);

        updateTambahHref();
        renderBackBtn();
    </script>
 @endpush