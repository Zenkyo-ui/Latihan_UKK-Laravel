@extends('layouts.app')

@section('title', 'Edit Kompetensi')

@section('content')
    <div class="page-header">
        <h1>Edit Kompetensi</h1>
        <p class="subtitle">Ubah data kompetensi {{ $kompetensi->nama_kompetensi }}.</p>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('kompetensi.update', $kompetensi->id) }}">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <div class="form-group full">
                        <label for="nama_kompetensi">Nama Kompetensi</label>
                        <input type="text" name="nama_kompetensi" id="nama_kompetensi" value="{{ old('nama_kompetensi', $kompetensi->nama_kompetensi) }}" class="{{ $errors->has('nama_kompetensi') ? 'is-invalid' : '' }}" required>
                        @error('nama_kompetensi') <div class="error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="{{ $errors->has('deskripsi') ? 'is-invalid' : '' }}">{{ old('deskripsi', $kompetensi->deskripsi) }}</textarea>
                        @error('deskripsi') <div class="error">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('kompetensi.index') }}" class="btn btn-ghost">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
