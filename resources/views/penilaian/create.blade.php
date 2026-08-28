@extends('layouts.app')

@section('title', 'Input Penilaian')

@section('content')
    <div class="page-header">
        <h1>Input Penilaian</h1>
        <p class="subtitle">Tambahkan hasil penilaian PKL siswa di perusahaan.</p>
    </div>

    @if ($errors->any())
        <div class="alert" style="background: var(--danger-light); color: var(--danger); border: 1px solid var(--danger);">
            <ul style="margin:0; padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('penilaian.store') }}">
                @csrf

                <div class="form-grid">
                    {{-- Pilih siswa yang belum dinilai --}}
                    <div class="form-group full">
                        <label for="siswa_id">Siswa</label>
                        <select name="siswa_id" id="siswa_id" class="@error('siswa_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach ($siswaList as $siswa)
                                <option value="{{ $siswa->id }}"
                                    {{ old('siswa_id', $selectedSiswaId) == $siswa->id ? 'selected' : '' }}>
                                    {{ $siswa->nama }} ({{ $siswa->nis }}) — {{ $siswa->perusahaan->nama_perusahaan ?? 'Belum ditugaskan' }}
                                </option>
                            @endforeach
                        </select>
                        @error('siswa_id') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    {{-- Tanggal penilaian --}}
                    <div class="form-group">
                        <label for="tanggal_penilaian">Tanggal Penilaian</label>
                        <input type="date" name="tanggal_penilaian" id="tanggal_penilaian" value="{{ old('tanggal_penilaian', date('Y-m-d')) }}" required>
                        @error('tanggal_penilaian') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    {{-- Skor (auto-fill status tamat via JS) --}}
                    <div class="form-group">
                        <label for="skor">Skor (0-100)</label>
                        <input type="number" name="skor" id="skor" min="0" max="100" value="{{ old('skor') }}"
                               class="@error('skor') is-invalid @enderror" oninput="autoStatusTamat()" required>
                        @error('skor') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    {{-- Status penguasaan --}}
                    <div class="form-group">
                        <label for="status_penguasaan">Status Penguasaan</label>
                        <select name="status_penguasaan" id="status_penguasaan" required>
                            @foreach (\App\Http\Controllers\PenilaianController::STATUS_PENGUASAAN as $item)
                                <option value="{{ $item }}" {{ old('status_penguasaan') == $item ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('status_penguasaan') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    {{-- Keaktifan --}}
                    <div class="form-group">
                        <label for="keaktifan">Keaktifan / Kehadiran</label>
                        <select name="keaktifan" id="keaktifan" required>
                            @foreach (\App\Http\Controllers\PenilaianController::KEAKTIFAN as $item)
                                <option value="{{ $item }}" {{ old('keaktifan') == $item ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('keaktifan') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    {{-- Sikap --}}
                    <div class="form-group">
                        <label for="sikap">Sikap / Attitude</label>
                        <select name="sikap" id="sikap" required>
                            @foreach (\App\Http\Controllers\PenilaianController::SIKAP as $item)
                                <option value="{{ $item }}" {{ old('sikap') == $item ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                        @error('sikap') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    {{-- Status tamat (manual, tapi auto-fill dari skor) --}}
                    <div class="form-group">
                        <label for="status_tamat">Status Tamat</label>
                        <select name="status_tamat" id="status_tamat" required>
                            @foreach (\App\Http\Controllers\PenilaianController::STATUS_TAMAT as $item)
                                <option value="{{ $item }}" {{ old('status_tamat') == $item ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                        <small style="color: var(--text-muted);">Otomatis terisi dari skor, bisa diubah manual.</small>
                        @error('status_tamat') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    {{-- Catatan --}}
                    <div class="form-group full">
                        <label for="catatan">Catatan Perusahaan</label>
                        <textarea name="catatan" id="catatan" rows="4" style="resize: vertical;" placeholder="Catatan dari pembimbing industri...">{{ old('catatan') }}</textarea>
                        @error('catatan') <small class="error">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('penilaian.index') }}" class="btn btn-ghost">Batal</a>
                </div>
            </form>
        </div>
    </div>

    {{-- JS: auto-fill status tamat dari skor saat user mengetik skor --}}
    <script>
        function autoStatusTamat() {
            const skor = document.getElementById('skor').value;
            const statusTamat = document.getElementById('status_tamat');
            // Ambil nilai minimum lulus dari PHP (70) → diteruskan ke JS
            const minLulus = {{ \App\Http\Controllers\PenilaianController::NILAI_MIN_LULUS }};
            statusTamat.value = (skor !== '' && Number(skor) >= minLulus) ? 'Lulus' : 'Tidak Lulus';
        }
    </script>
@endsection
