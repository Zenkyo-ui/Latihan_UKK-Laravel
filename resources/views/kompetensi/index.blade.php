@extends('layouts.app')

@section('title', 'Kompetensi')

@section('content')
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1>Kompetensi (Skill)</h1>
            <p class="subtitle">{{ $skillList->count() }} skill yang dikelompokkan berdasarkan jurusan.</p>
        </div>
        <a href="{{ route('kompetensi.create') }}" class="btn btn-primary">+ Tambah</a>
    </div>

    @include('partials.alert')

    <div class="card">
        <div class="card-header">
            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="cariKompetensi" placeholder="Cari skill...">
            </div>
        </div>
        <div style="overflow-x: auto;">
            <table id="tabelKompetensi">
                <thead>
                    <tr>
                        <th style="width:50px">No</th>
                        <th data-sort="nama">Nama Skill</th>
                        <th>Deskripsi</th>
                        <th>Jurusan</th>
                        <th>Yang Menguasai</th>
                        <th style="width:180px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($skillList as $skill)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong data-nama="{{ $skill->nama_skill }}">{{ $skill->nama_skill }}</strong></td>
                            <td>{{ $skill->deskripsi ?? '-' }}</td>
                            <td>
                                {{-- dengan('kompetensi') → $skill->kompetensi = jurusan yang memakai skill ini --}}
                                @forelse ($skill->kompetensi as $k)
                                    {{ $k->nama_kompetensi }}{{ !$loop->last ? ', ' : '' }}
                                @empty
                                    <span style="color: var(--text-muted);">Belum ada jurusan</span>
                                @endforelse
                            </td>
                            <td>
                                {{-- withCount('siswa') → $skill->siswa_count = jumlah siswa yang menguasai --}}
                                <span class="badge badge-success">{{ $skill->siswa_count }} siswa</span>
                            </td>
                            <td style="display: flex; align-items: center; gap: 4px; white-space: nowrap;">
                                <a href="{{ route('kompetensi.show', $skill->id) }}" class="btn btn-primary" style="padding: 5px 10px; font-size: 0.75rem; line-height: 1.2;">Detail</a>
                                <a href="{{ route('kompetensi.edit', $skill->id) }}" class="btn btn-secondary" style="padding: 5px 10px; font-size: 0.75rem; line-height: 1.2;">Edit</a>
                                <form method="POST" action="{{ route('kompetensi.destroy', $skill->id) }}" onsubmit="return confirm('Yakin hapus skill ini?')" style="display: inline-flex; align-items: center;">
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
                        <tr><td colspan="6" class="empty-state">Belum ada data skill.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection