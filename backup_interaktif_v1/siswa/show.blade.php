@extends('layouts.app')

@section('title', $siswa->nama)

@section('content')
    <h1>{{ $siswa->nama }}</h1>
    <p class="subjudul">Informasi lengkap siswa yang melaksanakan PKL.</p>

    <table>
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

    <p style="margin-top: 20px;">
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">&laquo; Kembali ke Daftar</a>
    </p>
@endsection
