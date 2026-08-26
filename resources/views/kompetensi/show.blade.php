@extends('layouts.app')

@section('title', $kompetensi->nama_kompetensi)

@section('content')
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1>{{ $kompetensi->nama_kompetensi }}</h1>
            <p class="subtitle">Detail kompetensi IT</p>
        </div>
        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
            <a href="{{ route('kompetensi.edit', $kompetensi->id) }}" class="btn btn-secondary">Edit</a>
            <form method="POST" action="{{ route('kompetensi.destroy', $kompetensi->id) }}" onsubmit="return confirm('Yakin hapus kompetensi ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" style="padding: 10px 18px; border: 1px solid var(--danger); border-radius: var(--radius);">Hapus</button>
            </form>
        </div>
    </div>

    <div class="card" style="margin-bottom: 20px;">
        <div class="card-body">
            <div class="detail-grid">
                <div class="detail-item" style="grid-column: 1 / -1;">
                    <dt>Nama Kompetensi</dt>
                    <dd>{{ $kompetensi->nama_kompetensi }}</dd>
                </div>
                <div class="detail-item" style="grid-column: 1 / -1;">
                    <dt>Deskripsi</dt>
                    <dd>{{ $kompetensi->deskripsi ?? '-' }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Jumlah Siswa</dt>
                    <dd>{{ $kompetensi->siswa_count }} siswa</dd>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong style="font-size: 0.95rem;">Daftar Siswa ({{ $kompetensi->siswa_count }})</strong>
        </div>
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th style="width:50px">No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kompetensi->siswa as $siswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><code style="background: var(--gray-100); padding: 2px 6px; border-radius: 4px; font-size: 0.85rem;">{{ $siswa->nis }}</code></td>
                            <td><strong>{{ $siswa->nama }}</strong></td>
                            <td>{{ $siswa->kelas }}</td>
                            <td>{{ $siswa->pivot->nilai ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty-state">Belum ada siswa yang mengambil kompetensi ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('kompetensi.index') }}" class="btn btn-ghost">← Kembali</a>
    </div>
@endsection
