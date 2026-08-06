@extends('layouts.app')

@section('title', 'Daftar Siswa PKL')

@section('content')
    <h1>Daftar Siswa PKL</h1>
    <p class="subjudul">Daftar siswa yang sedang melaksanakan PKL di perusahaan mitra. Gunakan pencarian atau klik tombol Detail.</p>

    <div class="toolbar">
        <input type="text" id="cari" class="cari" placeholder="Cari NIS / nama / kelas..." onkeyup="filterTabel()">
    </div>

    <table id="tabel">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Perusahaan</th>
                <th>Mulai PKL</th>
                <th>Selesai PKL</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($siswaList as $siswa)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->kelas }}</td>
                    <td>{{ $siswa->perusahaan->nama_perusahaan ?? '-' }}</td>
                    <td>{{ $siswa->tanggal_mulai_pkl }}</td>
                    <td>{{ $siswa->tanggal_selesai_pkl }}</td>
                    <td>
                        <a href="{{ route('siswa.show', $siswa->nis) }}" class="btn btn-primary btn-sm">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="kosong">Belum ada data siswa PKL.</td>
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
