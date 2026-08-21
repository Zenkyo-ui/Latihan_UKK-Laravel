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
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('siswa.index') }}" class="btn btn-ghost">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
