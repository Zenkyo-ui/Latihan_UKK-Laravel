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

    <div class="card">
        <div class="card-header">
            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="cariPerusahaan" placeholder="Cari perusahaan...">
            </div>
        </div>
        <div style="overflow-x: auto;">
            <table id="tabelPerusahaan">
                <thead>
                    <tr>
                        <th style="width:50px">No</th>
                        <th data-sort="nama">Nama Perusahaan</th>
                        <th data-sort="bidang">Bidang Usaha</th>
                        <th>Alamat</th>
                        <th>Pembimbing</th>
                        <th>Kuota</th>
                        <th>Sisa</th>
                        <th style="width:180px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($perusahaanList as $perusahaan)
                        @php
                            $sisa = $perusahaan->kuota - $perusahaan->siswa_count;
                            $penuh = $sisa <= 0;
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong data-nama="{{ $perusahaan->nama_perusahaan }}">{{ $perusahaan->nama_perusahaan }}</strong></td>
                            <td data-bidang="{{ $perusahaan->bidang_usaha }}">{{ $perusahaan->bidang_usaha }}</td>
                            <td>{{ $perusahaan->alamat }}</td>
                            <td>{{ $perusahaan->nama_pembimbing_industri }}</td>
                            <td>{{ $perusahaan->siswa_count }} / {{ $perusahaan->kuota }}</td>
                            <td>
                                @if ($penuh)
                                    <span style="color: var(--danger); font-weight: 600;">Penuh</span>
                                @else
                                    <span style="color: var(--success);">{{ $sisa }}</span>
                                @endif
                            </td>
                            <td style="display: flex; align-items: center; gap: 4px; white-space: nowrap;">
                                <a href="{{ route('perusahaan.show', $perusahaan->id) }}" class="btn btn-primary" style="padding: 5px 10px; font-size: 0.75rem; line-height: 1.2;">Detail</a>
                                <a href="{{ route('perusahaan.edit', $perusahaan->id) }}" class="btn btn-secondary" style="padding: 5px 10px; font-size: 0.75rem; line-height: 1.2;">Edit</a>
                                <form method="POST" action="{{ route('perusahaan.destroy', $perusahaan->id) }}" onsubmit="return confirm('Yakin hapus perusahaan ini?')" style="display: inline-flex; align-items: center;">
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
                        <tr><td colspan="8" class="empty-state">Belum ada data perusahaan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
