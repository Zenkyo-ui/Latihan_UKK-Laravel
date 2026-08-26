@extends('layouts.app')

@section('title', $siswa->nama)

@section('content')
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1>{{ $siswa->nama }}</h1>
            <p class="subtitle">Detail data siswa PKL</p>
        </div>
        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
            <a href="{{ route('siswa.edit', $siswa->nis) }}" class="btn btn-secondary">Edit</a>
            <form method="POST" action="{{ route('siswa.destroy', $siswa->nis) }}" onsubmit="return confirm('Yakin hapus siswa ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete" style="padding: 10px 18px; border: 1px solid var(--danger); border-radius: var(--radius);">Hapus</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <dt>NIS</dt>
                    <dd><code style="background: var(--gray-100); padding: 2px 8px; border-radius: 4px; font-size: 0.9rem;">{{ $siswa->nis }}</code></dd>
                </div>
                <div class="detail-item">
                    <dt>Kelas</dt>
                    <dd>{{ $siswa->kelas }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Perusahaan Mitra</dt>
                    <dd>
                        @if ($siswa->perusahaan)
                            <span class="badge badge-success">{{ $siswa->perusahaan->nama_perusahaan }}</span>
                        @else
                            <span class="badge badge-warning">Belum ditugaskan</span>
                        @endif
                    </dd>
                </div>
                <div class="detail-item">
                    <dt>Mulai PKL</dt>
                    <dd>{{ $siswa->tanggal_mulai_pkl }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Selesai PKL</dt>
                    <dd>{{ $siswa->tanggal_selesai_pkl }}</dd>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('siswa.index') }}" class="btn btn-ghost">← Kembali</a>
    </div>
@endsection
