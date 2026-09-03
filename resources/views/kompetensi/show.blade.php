@extends('layouts.app')

@section('title', $skill->nama_skill)

@section('content')
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1>{{ $skill->nama_skill }}</h1>
            <p class="subtitle">Detail skill beserta jurusan dan siswa yang memakainya</p>
        </div>
        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
            <a href="{{ route('kompetensi.edit', $skill->id) }}" class="btn btn-secondary">Edit</a>
            <form method="POST" action="{{ route('kompetensi.destroy', $skill->id) }}" onsubmit="return confirm('Yakin hapus skill ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="padding: 10px 18px; display: inline-flex; align-items: center; gap: 6px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    Hapus
                                </button>
            </form>
        </div>
    </div>

    <div class="card" style="margin-bottom: 20px;">
        <div class="card-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <dt>Nama Skill</dt>
                    <dd>{{ $skill->nama_skill }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Deskripsi</dt>
                    <dd>{{ $skill->deskripsi ?? '-' }}</dd>
                </div>
                <div class="detail-item">
                    <dt>Jurusan yang Memakai</dt>
                    <dd>
                        @forelse ($skill->kompetensi as $k)
                            <span class="badge" style="background: var(--primary-light); color: var(--primary-dark);">{{ $k->nama_kompetensi }}</span>
                        @empty
                            <span class="badge badge-warning">Belum ada jurusan</span>
                        @endforelse
                    </dd>
                </div>
                <div class="detail-item">
                    <dt>Yang Menguasai</dt>
                    <dd><span class="badge badge-success">{{ $skill->siswa_count }} siswa</span></dd>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong style="font-size: 0.95rem;">Daftar Siswa yang Menguasai ({{ $skill->siswa_count }})</strong>
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
                    @forelse ($skill->siswa as $siswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><code style="background: var(--gray-100); padding: 2px 6px; border-radius: 4px; font-size: 0.85rem;">{{ $siswa->nis }}</code></td>
                            <td><strong>{{ $siswa->nama }}</strong></td>
                            <td>{{ $siswa->kelas }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty-state">Belum ada siswa yang menguasai skill ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('kompetensi.index') }}" class="btn btn-ghost">← Kembali</a>
    </div>
@endsection