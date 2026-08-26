@extends('layouts.app')

@section('title', 'Data Kompetensi')

@section('content')
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: start; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1>Data Kompetensi IT</h1>
            <p class="subtitle">{{ $kompetensiList->count() }} kompetensi terdaftar.</p>
        </div>
        <a href="{{ route('kompetensi.create') }}" class="btn btn-primary">+ Tambah</a>
    </div>

    @include('partials.alert')

    <div class="card">
        <div class="card-header">
            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="cariKompetensi" placeholder="Cari kompetensi...">
            </div>
        </div>
        <div style="overflow-x: auto;">
            <table id="tabelKompetensi">
                <thead>
                    <tr>
                        <th style="width:50px">No</th>
                        <th data-sort="nama">Nama Kompetensi</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Siswa</th>
                        <th style="width:180px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kompetensiList as $kompetensi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong data-nama="{{ $kompetensi->nama_kompetensi }}">{{ $kompetensi->nama_kompetensi }}</strong></td>
                            <td>{{ $kompetensi->deskripsi ?? '-' }}</td>
                            <td>
                                <span class="badge badge-success">{{ $kompetensi->siswa_count }} siswa</span>
                            </td>
                            <td style="display: flex; gap: 4px; flex-wrap: wrap;">
                                <a href="{{ route('kompetensi.show', $kompetensi->id) }}" class="btn btn-primary" style="padding: 5px 10px; font-size: 0.75rem;">Detail</a>
                                <a href="{{ route('kompetensi.edit', $kompetensi->id) }}" class="btn btn-secondary" style="padding: 5px 10px; font-size: 0.75rem;">Edit</a>
                                <form method="POST" action="{{ route('kompetensi.destroy', $kompetensi->id) }}" onsubmit="return confirm('Yakin hapus kompetensi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty-state">Belum ada data kompetensi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
