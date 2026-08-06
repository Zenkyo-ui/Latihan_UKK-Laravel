@extends('layouts.app')

@section('title', 'Daftar Perusahaan Mitra')

@section('content')
    <h1>Daftar Perusahaan Mitra</h1>
    <p>Halaman ini menampilkan daftar perusahaan mitra yang bekerja sama dengan SMK untuk program PKL. Silakan pilih perusahaan yang sesuai untuk informasi lebih lanjut.</p>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Perusahaan</th>
                <th>Bidang Usaha</th>
                <th>Alamat</th>
                <th>Pembimbing Industri</th>
                <th>Telepon</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($perusahaanList as $perusahaan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('perusahaan.show', $perusahaan->id) }}">
                            {{ $perusahaan->nama_perusahaan }}
                        </a>
                    </td>
                    <td>{{ $perusahaan->bidang_usaha }}</td>
                    <td>{{ $perusahaan->alamat }}</td>
                    <td>{{ $perusahaan->nama_pembimbing_industri }}</td>
                    <td>{{ $perusahaan->telepon }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data perusahaan mitra.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
