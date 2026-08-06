@extends('layouts.app')

@section('title', $perusahaan->nama_perusahaan)

@section('content')
    <h1>{{ $perusahaan->nama_perusahaan }}</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Bidang Usaha</th>
            <td>{{ $perusahaan->bidang_usaha }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $perusahaan->alamat }}</td>
        </tr>
        <tr>
            <th>Pembimbing Industri</th>
            <td>{{ $perusahaan->nama_pembimbing_industri }}</td>
        </tr>
        <tr>
            <th>Telepon</th>
            <td>{{ $perusahaan->telepon }}</td>
        </tr>
    </table>

    <p>
        <a href="{{ route('perusahaan.index') }}">&laquo; Kembali ke daftar perusahaan</a>
    </p>
@endsection
