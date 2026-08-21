@extends('layouts.app')

@section('title', 'Data Perusahaan')

@section('content')
    <div class="page-header">
        <h1>Data Perusahaan Mitra</h1>
        <p class="subtitle">{{ $perusahaanList->count() }} perusahaan terdaftar sebagai mitra PKL.</p>
    </div>

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
                        <th style="width:90px">Aksi</th>
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
                                    <span class="badge badge-danger">Penuh</span>
                                @else
                                    <span class="badge badge-success">{{ $sisa }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('perusahaan.show', $perusahaan->id) }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 0.8rem;">Detail</a>
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
