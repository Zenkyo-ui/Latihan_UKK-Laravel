{{-- PARTIAL: ALERT (FLASH MESSAGE) --}}
{{-- ================================ --}}
{{-- Notifikasi sukses setelah operasi CRUD --}}
{{-- --}}
{{-- session('success') = ambil data 'success' dari session --}}
{{-- Controller mengirimnya dengan: ->with('success', 'Pesannya') --}}
{{-- --}}
{{-- Contoh penggunaan: --}}
{{--   1. User klik "Hapus" → controller hapus data --}}
{{--   2. Controller: redirect(...)->with('success', 'Berhasil dihapus.') --}}
{{--   3. Alert ini menampilkan: "Berhasil dihapus." --}}
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
