@extends('layouts.app')

@section('title', $perusahaan->nama_perusahaan)

@section('content')
    <h1>{{ $perusahaan->nama_perusahaan }}</h1>
    <p class="subjudul">Informasi lengkap perusahaan mitra PKL.</p>

    <table>
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

    <p style="margin-top: 20px;">
        <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary">&laquo; Kembali ke Daftar</a>
    </p>
@endsection
