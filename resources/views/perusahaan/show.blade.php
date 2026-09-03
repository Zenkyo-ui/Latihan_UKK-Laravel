@extends('layouts.app')

@section('title', $perusahaan->nama_perusahaan)

@section('content')
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1>{{ $perusahaan->nama_perusahaan }}</h1>
            <p class="subtitle">Detail perusahaan mitra PKL</p>
        </div>
        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
            <a href="{{ route('perusahaan.edit', $perusahaan->id) }}" class="btn btn-secondary">Edit</a>
            <form method="POST" action="{{ route('perusahaan.destroy', $perusahaan->id) }}" onsubmit="return confirm('Yakin hapus perusahaan ini? Semua siswa terkait juga akan terhapus.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="padding: 10px 18px; display: inline-flex; align-items: center; gap: 6px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    Hapus
                                </button>
            </form>
        </div>
    </div>

    @php
        $sisa = $perusahaan->kuota - $perusahaan->siswa_count;
        $penuh = $sisa <= 0;
    @endphp

    <div class="card" style="margin-bottom: 20px;">
        <div class="card-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <dt>Bidang Usaha</dt>
                    <dd>{{ $perusahaan->bidang_usaha }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Alamat</dt>
                    <dd>{{ $perusahaan->alamat }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Pembimbing Industri</dt>
                    <dd>{{ $perusahaan->nama_pembimbing_industri }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Telepon</dt>
                    <dd>{{ $perusahaan->telepon }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Kuota</dt>
                    <dd>{{ $perusahaan->kuota }} siswa</dd>
                </div>
                <div class="detail-item">
                    <dt>Sisa Kuota</dt>
                    <dd>
                        @if ($penuh)
                            <span class="badge badge-danger">Penuh</span>
                        @else
                            <span class="badge badge-success">{{ $sisa }} siswa</span>
                        @endif
                    </dd>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong style="font-size: 0.95rem;">Daftar Siswa ({{ $perusahaan->siswa_count }})</strong>
        </div>
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th style="width:50px">No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($perusahaan->siswa as $siswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><code style="background: var(--gray-100); padding: 2px 6px; border-radius: 4px; font-size: 0.85rem;">{{ $siswa->nis }}</code></td>
                            <td><strong>{{ $siswa->nama }}</strong></td>
                            <td>{{ $siswa->kelas }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty-state">Belum ada siswa di perusahaan ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('perusahaan.index') }}" class="btn btn-ghost">← Kembali</a>
    </div>
@endsection
