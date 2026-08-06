@extends('layouts.app')

@section('title', $siswa->nama)

@section('content')
    <h1>{{ $siswa->nama }}</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>NIS</th>
            <td>{{ $siswa->nis }}</td>
        </tr>
        <tr>
            <th>Kelas</th>
            <td>{{ $siswa->kelas }}</td>
        </tr>
        <tr>
            <th>Perusahaan</th>
            <td>{{ $siswa->perusahaan->nama_perusahaan ?? '-' }}</td>
        </tr>
        <tr>
            <th>Mulai PKL</th>
            <td>{{ $siswa->tanggal_mulai_pkl }}</td>
        </tr>
        <tr>
            <th>Selesai PKL</th>
            <td>{{ $siswa->tanggal_selesai_pkl }}</td>
        </tr>
    </table>

    <p>
        <a href="{{ route('siswa.index') }}">&laquo; Kembali ke daftar siswa</a>
    </p>
@endsection
