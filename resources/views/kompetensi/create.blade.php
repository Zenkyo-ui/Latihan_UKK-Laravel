@extends('layouts.app')

@section('title', 'Tambah Kompetensi')

@section('content')
    <div class="page-header">
        <h1>Tambah Kompetensi</h1>
        <p class="subtitle">Tambahkan kompetensi IT baru yang dipelajari selama PKL.</p>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('kompetensi.store') }}">
                @csrf
                <div class="form-grid">
                    <div class="form-group full">
                        <label for="nama_kompetensi">Nama Kompetensi</label>
                        <input type="text" name="nama_kompetensi" id="nama_kompetensi" value="{{ old('nama_kompetensi') }}" class="{{ $errors->has('nama_kompetensi') ? 'is-invalid' : '' }}" required>
                        @error('nama_kompetensi') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="{{ $errors->has('deskripsi') ? 'is-invalid' : '' }}">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <div class="error">{{ $message }}</div> @enderror
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
