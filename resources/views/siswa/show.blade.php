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
                <button type="submit" class="btn btn-danger" style="padding: 10px 18px; display: inline-flex; align-items: center; gap: 6px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    Hapus
                                </button>
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
                    <dt>Jurusan</dt>
                    <dd>
                        @if ($siswa->kompetensi)
                            <span class="badge badge-success">{{ $siswa->kompetensi->nama_kompetensi }}</span>
                        @else
                            <span class="badge badge-warning">Belum ditentukan</span>
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

            <div class="detail-item" style="margin-top: 18px;">
                <dt>Skill yang Dikuasai ({{ $siswa->skills->count() }})</dt>
                <dd>
                    @forelse ($siswa->skills as $skill)
                        <span class="badge" style="background: var(--primary-light); color: var(--primary-dark);">{{ $skill->nama_skill }}</span>
                    @empty
                        <span class="badge badge-warning">Belum ada skill</span>
                    @endforelse
                </dd>
            </div>
        </div>
    </div>

    {{-- KARTU PENILAIAN PKL — tempat "Input Nilai" atau ringkasan nilai jika sudah ada --}}
    {{-- $siswa->penilaian → relasi hasOne: berisi null kalau siswa belum dinilai --}}
    <div class="card" style="margin-top: 20px;">
        <div class="card-header">
            <h2 style="font-size:1.1rem; color: var(--text-strong);">Penilaian PKL</h2>
            @if ($siswa->penilaian)
                <a href="{{ route('penilaian.edit', $siswa->penilaian->id) }}" class="btn btn-secondary">Edit Nilai</a>
            @else
                <a href="{{ route('penilaian.create', ['siswa_id' => $siswa->id]) }}" class="btn btn-primary">+ Input Nilai</a>
            @endif
        </div>
        <div class="card-body">
            @if ($siswa->penilaian)
                <div class="detail-grid">
                    <div class="detail-item">
                        <dt>Skor</dt>
                        <dd style="font-size:1.5rem; font-weight:700; color: var(--text-strong);">{{ $siswa->penilaian->skor }}</dd>
                    </div>
                    <div class="detail-item">
                        <dt>Status Penguasaan</dt>
                        <dd>
                            <span class="badge" style="background: var(--primary-light); color: var(--primary-dark);">{{ $siswa->penilaian->status_penguasaan }}</span>
                        </dd>
                    </div>
                    <div class="detail-item">
                        <dt>Keaktifan</dt>
                        <dd>{{ $siswa->penilaian->keaktifan }}</dd>
                    </div>
                    <div class="detail-item">
                        <dt>Sikap</dt>
                        <dd>{{ $siswa->penilaian->sikap }}</dd>
                    </div>
                    <div class="detail-item">
                        <dt>Status Tamat</dt>
                        <dd>
                            @if ($siswa->penilaian->status_tamat === 'Lulus')
                                <span class="badge badge-success">Lulus</span>
                            @else
                                <span class="badge badge-danger">Tidak Lulus</span>
                            @endif
                        </dd>
                    </div>
                </div>
            @else
                <p style="color: var(--text-muted);">Siswa ini belum memiliki penilaian PKL.</p>
            @endif
        </div>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('siswa.index') }}" class="btn btn-ghost">← Kembali</a>
    </div>
@endsection