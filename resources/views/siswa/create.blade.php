@extends('layouts.app')

@section('title', 'Tambah Siswa')

@section('content')
    <div class="page-header">
        <h1>Tambah Siswa</h1>
        <p class="subtitle">Isi data siswa yang akan melaksanakan PKL.</p>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('siswa.store') }}">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" name="nis" id="nis" value="{{ old('nis') }}" class="{{ $errors->has('nis') ? 'is-invalid' : '' }}" required>
                        @error('nis') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Siswa</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="{{ $errors->has('nama') ? 'is-invalid' : '' }}" required>
                        @error('nama') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" name="kelas" id="kelas" value="{{ old('kelas') }}" class="{{ $errors->has('kelas') ? 'is-invalid' : '' }}" required>
                        @error('kelas') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="perusahaan_id">Perusahaan Mitra</label>
                        <select name="perusahaan_id" id="perusahaan_id" class="{{ $errors->has('perusahaan_id') ? 'is-invalid' : '' }}" required>
                            <option value="">-- Pilih Perusahaan --</option>
                            @foreach ($perusahaanList as $p)
                                <option value="{{ $p->id }}" {{ old('perusahaan_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_perusahaan }} ({{ $p->kuota - $p->siswa_count }} kuota tersisa)
                                </option>
                            @endforeach
                        </select>
                        @error('perusahaan_id') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="kompetensi_id">Jurusan</label>
                        <select name="kompetensi_id" id="kompetensi_id" class="{{ $errors->has('kompetensi_id') ? 'is-invalid' : '' }}" required>
                            <option value="">-- Pilih Jurusan --</option>
                            @foreach ($kompetensiList as $k)
                                <option value="{{ $k->id }}" {{ old('kompetensi_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kompetensi }}
                                </option>
                            @endforeach
                        </select>
                        @error('kompetensi_id') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_mulai_pkl">Mulai PKL</label>
                        <input type="date" name="tanggal_mulai_pkl" id="tanggal_mulai_pkl" value="{{ old('tanggal_mulai_pkl') }}" class="{{ $errors->has('tanggal_mulai_pkl') ? 'is-invalid' : '' }}" required>
                        @error('tanggal_mulai_pkl') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_selesai_pkl">Selesai PKL</label>
                        <input type="date" name="tanggal_selesai_pkl" id="tanggal_selesai_pkl" value="{{ old('tanggal_selesai_pkl') }}" class="{{ $errors->has('tanggal_selesai_pkl') ? 'is-invalid' : '' }}" required>
                        @error('tanggal_selesai_pkl') <div class="error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label>Skill yang Dikuasai</label>
                    {{-- Container diisi JavaScript (AJAX) saat jurusan dipilih.
                         Tidak di-render statis lagi supaya skill sesuai jurusan. --}}
                    <div id="skillContainer" class="skill-checkbox-container">
                        <p style="color: var(--text-muted); margin: 0;">Pilih jurusan dulu untuk melihat daftar skill.</p>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('siswa.index') }}" class="btn btn-ghost">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        {{-- NIP: variabel yang dikirim controller untuk pre-check (di create selalu kosong) --}}
        const selectedSkillIds = @json(old('skill_ids', []));

        {{-- AMBIL SKILL DARI JURUSAN (AJAX) -> render jadi checkbox --}}
        function loadSkills(kompetensiId) {
            const container = document.getElementById('skillContainer');
            const jurusan = document.getElementById('kompetensi_id');

            // Kalau belum pilih jurusan → tampilkan pesan
            if (!kompetensiId) {
                container.innerHTML = '<p style="color: var(--text-muted); margin: 0;">Pilih jurusan dulu untuk melihat daftar skill.</p>';
                return;
            }

            container.innerHTML = '<p style="color: var(--text-muted); margin: 0;">Memuat skill...</p>';

            // fetch = AJAX bawaan JavaScript. URL mengembalikan JSON dari controller.
            fetch(`/kompetensi/${kompetensiId}/skills`)
                .then(response => response.json())
                .then(skills => {
                    if (!skills.length) {
                        container.innerHTML = '<p style="color: var(--text-muted); margin: 0;">Belum ada skill untuk jurusan ini.</p>';
                        return;
                    }

                    // Susun HTML checkbox satu per satu
                    let html = '';
                    skills.forEach(skill => {
                        const checked = selectedSkillIds.includes(skill.id) ? 'checked' : '';
                        html += `
                            <label style="display: inline-flex; align-items: center; gap: 6px; background: var(--gray-100); padding: 6px 12px; border-radius: var(--radius); cursor: pointer;">
                                <input type="checkbox" name="skill_ids[]" value="${skill.id}" ${checked}>
                                ${skill.nama_skill}
                            </label>
                        `;
                    });
                    container.innerHTML = html;
                })
                .catch(() => {
                    container.innerHTML = '<p style="color: var(--danger); margin: 0;">Gagal memuat skill. Coba lagi.</p>';
                });
        }

        {{-- SAAT DROPDOWN JURUSAN BERUBAH -> muat ulang skill --}}
        document.getElementById('kompetensi_id').addEventListener('change', function () {
            selectedSkillIds.length = 0; // reset pilihan lama supaya tidak salah centang
            loadSkills(this.value);
        });

        {{-- SAAT HALAMAN PERTAMA KALI DIBUKA: kalau jurusan sudah terpilih (misal old()), load langsung --}}
        document.addEventListener('DOMContentLoaded', function () {
            const komp = document.getElementById('kompetensi_id');
            if (komp.value) loadSkills(komp.value);
        });
    </script>
@endpush
