@extends('layouts.app')

@section('title', 'Daftar Perusahaan Mitra')

@section('content')
    <h1>Daftar Perusahaan Mitra</h1>
    <p class="subjudul">Daftar perusahaan yang bekerja sama dengan SMK untuk program PKL. Gunakan pencarian atau klik tombol Detail untuk info lebih lanjut.</p>

    <div class="toolbar">
        <input type="text" id="cari" class="cari" placeholder="Cari nama / bidang usaha..." onkeyup="filterTabel()">
    </div>

    <table id="tabel">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Perusahaan</th>
                <th>Bidang Usaha</th>
                <th>Alamat</th>
                <th>Pembimbing Industri</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($perusahaanList as $perusahaan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $perusahaan->nama_perusahaan }}</td>
                    <td>{{ $perusahaan->bidang_usaha }}</td>
                    <td>{{ $perusahaan->alamat }}</td>
                    <td>{{ $perusahaan->nama_pembimbing_industri }}</td>
                    <td>
                        <a href="{{ route('perusahaan.show', $perusahaan->id) }}" class="btn btn-primary btn-sm">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="kosong">Belum ada data perusahaan mitra.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <script>
        function filterTabel() {
            const keyword = document.getElementById('cari').value.toLowerCase();
            const rows = document.querySelectorAll('#tabel tbody tr');
            rows.forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
            });
        }
    </script>
@endsection
