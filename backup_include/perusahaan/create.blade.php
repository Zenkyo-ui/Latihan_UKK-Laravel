@extends('layouts.app')

@section('title', 'Tambah Perusahaan')

@section('content')
    <div class="page-header">
        <h1>Tambah Perusahaan</h1>
        <p class="subtitle">Isi data perusahaan mitra PKL yang baru.</p>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('perusahaan.store') }}">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan</label>
                        <input type="text" name="nama_perusahaan" id="nama_perusahaan" value="{{ old('nama_perusahaan') }}" class="{{ $errors->has('nama_perusahaan') ? 'is-invalid' : '' }}" required>
                        @error('nama_perusahaan') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="bidang_usaha">Bidang Usaha</label>
                        <input type="text" name="bidang_usaha" id="bidang_usaha" value="{{ old('bidang_usaha') }}" class="{{ $errors->has('bidang_usaha') ? 'is-invalid' : '' }}" required>
                        @error('bidang_usaha') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" class="{{ $errors->has('alamat') ? 'is-invalid' : '' }}" required>{{ old('alamat') }}</textarea>
                        @error('alamat') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_pembimbing_industri">Pembimbing Industri</label>
                        <input type="text" name="nama_pembimbing_industri" id="nama_pembimbing_industri" value="{{ old('nama_pembimbing_industri') }}">
                    </div>
                    <div class="form-group">
                        <label for="telepon">Telepon</label>
                        <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}">
                    </div>
                    <div class="form-group">
                        <label for="kuota">Kuota Siswa</label>
                        <input type="number" name="kuota" id="kuota" value="{{ old('kuota', 3) }}" min="1" class="{{ $errors->has('kuota') ? 'is-invalid' : '' }}" required>
                        @error('kuota') <div class="error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('perusahaan.index') }}" class="btn btn-ghost">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
