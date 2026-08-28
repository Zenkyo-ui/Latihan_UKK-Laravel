@extends('layouts.app')

@section('title', 'Detail Penilaian')

@section('content')
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1>Detail Penilaian</h1>
            <p class="subtitle">{{ $penilaian->siswa->nama ?? 'Siswa' }} — {{ $penilaian->siswa->perusahaan->nama_perusahaan ?? 'Perusahaan' }}</p>
        </div>
        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
            <a href="{{ route('penilaian.edit', $penilaian->id) }}" class="btn btn-secondary">Edit</a>
            <form method="POST" action="{{ route('penilaian.destroy', $penilaian->id) }}" onsubmit="return confirm('Yakin hapus penilaian ini?')">
                @csrf
                @method('DELETE')
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="btn" style="background: var(--danger); color: white;">Hapus</a>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- Info siswa & perusahaan --}}
            <div class="detail-grid">
                <div class="detail-item">
                    <dt>Nama Siswa</dt>
                    <dd>{{ $penilaian->siswa->nama ?? '-' }}</dd>
                </div>
                <div class="detail-item">
                    <dt>NIS</dt>
                    <dd><code style="background: var(--gray-100); padding: 2px 8px; border-radius: 4px;">{{ $penilaian->siswa->nis ?? '-' }}</code></dd>
                </div>
                <div class="detail-item">
                    <dt>Perusahaan</dt>
                    <dd>{{ $penilaian->siswa->perusahaan->nama_perusahaan ?? '-' }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Tanggal Penilaian</dt>
                    <dd>{{ $penilaian->tanggal_penilaian }}</dd>
                </div>
            </div>

            {{-- Hasil penilaian --}}
            <div class="detail-grid">
                <div class="detail-item">
                    <dt>Skor Kompetensi</dt>
                    <dd style="font-size: 1.5rem; font-weight: 700; color: var(--text-strong);">{{ $penilaian->skor }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Status Penguasaan</dt>
                    <dd>
                        <span class="badge" style="background: var(--primary-light); color: var(--primary-dark);">{{ $penilaian->status_penguasaan }}</span>
                    </dd>
                </div>
                <div class="detail-item">
                    <dt>Keaktifan / Kehadiran</dt>
                    <dd>{{ $penilaian->keaktifan }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Sikap / Attitude</dt>
                    <dd>{{ $penilaian->sikap }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Status Tamat</dt>
                    <dd>
                        @if ($penilaian->status_tamat === 'Lulus')
                            <span class="badge badge-success">Lulus</span>
                        @else
                            <span class="badge badge-danger">Tidak Lulus</span>
                        @endif
                    </dd>
                </div>
            </div>

            {{-- Catatan perusahaan --}}
            @if ($penilaian->catatan)
                <div class="detail-item" style="margin-top: 16px;">
                    <dt>Catatan Perusahaan</dt>
                    <dd style="font-weight: 400; white-space: pre-wrap;">{{ $penilaian->catatan }}</dd>
                </div>
            @endif
        </div>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('penilaian.index') }}" class="btn btn-ghost">← Kembali</a>
    </div>
@endsection
