@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
    <div class="page-header">
        <h1>Data Siswa PKL</h1>
        <p class="subtitle">{{ $siswaList->count() }} siswa terdaftar dalam program PKL.</p>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" id="cariSiswa" placeholder="Cari NIS, nama, atau kelas...">
            </div>
        </div>
        <div style="overflow-x: auto;">
            <table id="tabelSiswa">
                <thead>
                    <tr>
                        <th style="width:50px">No</th>
                        <th data-sort="nis">NIS</th>
                        <th data-sort="nama">Nama</th>
                        <th data-sort="kelas">Kelas</th>
                        <th>Perusahaan</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th style="width:90px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswaList as $siswa)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><code data-nis="{{ $siswa->nis }}" style="background: var(--gray-100); padding: 2px 6px; border-radius: 4px; font-size: 0.85rem;">{{ $siswa->nis }}</code></td>
                            <td><strong data-nama="{{ $siswa->nama }}">{{ $siswa->nama }}</strong></td>
                            <td data-kelas="{{ $siswa->kelas }}">{{ $siswa->kelas }}</td>
                            <td>
                                @if ($siswa->perusahaan)
                                    <span class="badge badge-success">{{ $siswa->perusahaan->nama_perusahaan }}</span>
                                @else
                                    <span class="badge badge-warning">Belum ditugaskan</span>
                                @endif
                            </td>
                            <td>{{ $siswa->tanggal_mulai_pkl }}</td>
                            <td>{{ $siswa->tanggal_selesai_pkl }}</td>
                            <td>
                                <a href="{{ route('siswa.show', $siswa->nis) }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 0.8rem;">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="empty-state">Belum ada data siswa.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
