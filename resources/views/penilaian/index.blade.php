@extends('layouts.app')

@section('title', 'Penilaian PKL')

@section('content')
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1>Penilaian PKL Siswa</h1>
            <p class="subtitle">{{ $penilaianList->count() }} penilaian hasil PKL di perusahaan.</p>
        </div>
        <a href="{{ route('penilaian.create') }}" class="btn btn-primary">+ Input Nilai</a>
    </div>

    @include('partials.alert')

    <div class="card">
        <div class="card-header">
            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="cariPenilaian" placeholder="Cari siswa atau perusahaan...">
            </div>
        </div>
        <div style="overflow-x: auto;">
            <table id="tabelPenilaian">
                <thead>
                    <tr>
                        <th style="width:50px">No</th>
                        <th>Tanggal</th>
                        <th>Siswa</th>
                        <th>Perusahaan</th>
                        <th>Skor</th>
                        <th>Status</th>
                        <th>Keaktifan</th>
                        <th>Sikap</th>
                        <th style="width:180px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penilaianList as $penilaian)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $penilaian->tanggal_penilaian }}</td>
                            <td>
                                @if ($penilaian->siswa)
                                    <strong>{{ $penilaian->siswa->nama }}</strong>
                                    <div style="font-size:0.75rem; color: var(--text-muted);">{{ $penilaian->siswa->nis }}</div>
                                @else
                                    <em style="color: var(--text-muted)">Siswa dihapus</em>
                                @endif
                            </td>
                            <td>
                                @if ($penilaian->siswa && $penilaian->siswa->perusahaan)
                                    {{ $penilaian->siswa->perusahaan->nama_perusahaan }}
                                @else
                                    <span style="color: var(--text-muted);">-</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $penilaian->skor }}</strong>
                            </td>
                            <td>
                                {{-- Badge warna: Lulus = hijau, Tidak Lulus = merah --}}
                                @if ($penilaian->status_tamat === 'Lulus')
                                    <span class="badge badge-success">Lulus</span>
                                @else
                                    <span class="badge badge-danger">Tidak Lulus</span>
                                @endif
                            </td>
                            <td>{{ $penilaian->keaktifan }}</td>
                            <td>{{ $penilaian->sikap }}</td>
                            <td style="display: flex; align-items: center; gap: 4px; white-space: nowrap;">
                                <a href="{{ route('penilaian.show', $penilaian->id) }}" class="btn btn-primary" style="padding: 5px 10px; font-size: 0.75rem; line-height: 1.2;">Detail</a>
                                <a href="{{ route('penilaian.edit', $penilaian->id) }}" class="btn btn-secondary" style="padding: 5px 10px; font-size: 0.75rem; line-height: 1.2;">Edit</a>
                                <form method="POST" action="{{ route('penilaian.destroy', $penilaian->id) }}" onsubmit="return confirm('Yakin hapus penilaian ini?')" style="display: inline-flex; align-items: center;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 0.75rem; line-height: 1.2; display: inline-flex; align-items: center; gap: 4px;">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="empty-state">Belum ada data penilaian.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
