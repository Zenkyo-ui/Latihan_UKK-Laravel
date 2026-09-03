@extends('layouts.app')

@section('title', 'Tambah Kompetensi')

@section('content')
    <div class="page-header">
        <h1>Tambah Kompetensi</h1>
        <p class="subtitle">Tambahkan skill baru dan tentukan jurusan mana yang memakainya.</p>
    </div>

    @if ($errors->any())
        <div class="alert" style="background: var(--danger-light); color: var(--danger); border: 1px solid var(--danger);">
            <ul style="margin:0; padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('kompetensi.store') }}">
                @csrf
                <div class="form-grid">
                    <div class="form-group full">
                        <label for="nama_skill">Nama Skill</label>
                        <input type="text" name="nama_skill" id="nama_skill" value="{{ old('nama_skill') }}" class="{{ $errors->has('nama_skill') ? 'is-invalid' : '' }}" placeholder="Contoh: Flutter, Desain Grafis, Jaringan MikroTik" required>
                        @error('nama_skill') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="{{ $errors->has('deskripsi') ? 'is-invalid' : '' }}">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <div class="error">{{ $message }}</div> @enderror
                    </div>

                    {{-- RELASI SKILL ↔ JURUSAN: centang jurusan yang memakai skill ini --}}
                    <div class="form-group full">
                        <label>Skill ini untuk jurusan mana?</label>
                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                            @php
                                // Pre-check: dari old() kalau ada error validasi,
                                // atau dari query ?jurusan=id (jurusan aktif saat "+ Tambah Skill" diklik).
                                $checkedJurusan = !empty(old('kompetensi_ids', []))
                                    ? old('kompetensi_ids')
                                    : ($defaultJurusan > 0 ? [$defaultJurusan] : []);
                            @endphp
                            @foreach ($kompetensiList as $k)
                                <label style="display: inline-flex; align-items: center; gap: 6px; background: var(--gray-100); padding: 6px 12px; border-radius: var(--radius); cursor: pointer;">
                                    <input type="checkbox" name="kompetensi_ids[]" value="{{ $k->id }}"
                                        {{ in_array($k->id, $checkedJurusan) ? 'checked' : '' }}>
                                    {{ $k->nama_kompetensi }}
                                </label>
                            @endforeach
                        </div>
                        @error('kompetensi_ids') <div class="error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('kompetensi.index') }}" class="btn btn-ghost">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection