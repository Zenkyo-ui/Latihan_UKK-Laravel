@extends('layouts.app')

@section('title', 'Data Perusahaan')

@section('content')
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1>Data Perusahaan Mitra</h1>
            <p class="subtitle">{{ $perusahaanList->count() }} perusahaan terdaftar sebagai mitra PKL.</p>
        </div>
        <a href="{{ route('perusahaan.create') }}" class="btn btn-primary">+ Tambah</a>
    </div>

    @include('partials.alert')

    <div class="home-grid">
        @forelse ($perusahaanList as $perusahaan)
            @php
                $sisa = $perusahaan->kuota - $perusahaan->siswa_count;
                $penuh = $sisa <= 0;
                $persen = $perusahaan->kuota > 0 ? round($perusahaan->siswa_count / $perusahaan->kuota * 100) : 0;
            @endphp
            <div class="home-card">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div class="home-card-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                    </div>
                    <div>
                        <h2 style="font-size:1.1rem; color:var(--text-strong);">{{ $perusahaan->nama_perusahaan }}</h2>
                        <span class="badge {{ $penuh ? 'badge-danger' : 'badge-success' }}" style="margin-top:4px;">
                            {{ $perusahaan->bidang_usaha }}
                        </span>
                    </div>
                </div>

                <p style="color:var(--text-muted); font-size:0.9rem; margin:0;">{{ $perusahaan->alamat }}</p>

                <div style="display:flex; align-items:center; justify-content:space-between; font-size:0.85rem;">
                    <span style="color:var(--text-muted);">Pembimbing</span>
                    <strong style="color:var(--text);">{{ $perusahaan->nama_pembimbing_industri ?: '-' }}</strong>
                </div>

                <div>
                    <div style="display:flex; align-items:center; justify-content:space-between; font-size:0.85rem; margin-bottom:6px;">
                        <span style="color:var(--text-muted);">Kuota terisi</span>
                        <strong style="color:var(--text);">{{ $perusahaan->siswa_count }} / {{ $perusahaan->kuota }}</strong>
                    </div>
                    <div style="height:8px; border-radius:9999px; background:var(--gray-200); overflow:hidden;">
                        <div style="height:100%; width:{{ $persen }}%; background:{{ $penuh ? 'var(--danger)' : 'var(--success)' }}; border-radius:9999px;"></div>
                    </div>
                    <div style="margin-top:6px; font-size:0.8rem; font-weight:600; {{ $penuh ? 'color:var(--danger);' : 'color:var(--success);' }}">
                        {{ $penuh ? 'Kuota Penuh' : 'Sisa ' . $sisa . ' slot' }}
                    </div>
                </div>

                <div style="display:flex; gap:6px; flex-wrap:wrap; margin-top:6px;">
                    <a href="{{ route('perusahaan.show', $perusahaan->id) }}" class="btn btn-primary" style="padding:7px 14px; font-size:0.78rem; line-height:1.2;">Detail</a>
                    <a href="{{ route('perusahaan.edit', $perusahaan->id) }}" class="btn btn-secondary" style="padding:7px 14px; font-size:0.78rem; line-height:1.2;">Edit</a>
                    <form method="POST" action="{{ route('perusahaan.destroy', $perusahaan->id) }}" onsubmit="return confirm('Yakin hapus perusahaan ini?')" style="display:inline-flex; align-items:center;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding:7px 14px; font-size:0.78rem; line-height:1.2;">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="empty-state" style="grid-column:1/-1;">Belum ada data perusahaan.</p>
        @endforelse
    </div>
@endsection