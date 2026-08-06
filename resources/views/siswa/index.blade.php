@extends('layouts.app')

@section('title', 'Daftar Siswa PKL')

@section('content')
    <h1>Daftar Siswa PKL</h1>
    <p>Halaman ini menampilkan daftar siswa yang sedang melaksanakan PKL di perusahaan mitra.</p>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Perusahaan</th>
                <th>Mulai PKL</th>
                <th>Selesai PKL</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($siswaList as $siswa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ route('siswa.show', $siswa->nis) }}">
                            {{ $siswa->nis }}
                        </a>
                    </td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->kelas }}</td>
                    <td>{{ $siswa->perusahaan->nama_perusahaan ?? '-' }}</td>
                    <td>{{ $siswa->tanggal_mulai_pkl }}</td>
                    <td>{{ $siswa->tanggal_selesai_pkl }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data siswa PKL.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
