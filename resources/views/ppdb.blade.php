@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">PPDB SMK Bina Insan Bangsa</h1>
            <p class="text-muted mb-0">Informasi gelombang penerimaan siswa baru, tanggal pendaftaran, dan poster resmi.</p>
        </div>

        @if ($activeWave)
            <div class="mb-5">
                <div class="rounded-4 shadow-sm overflow-hidden bg-white">
                    @if ($activeWave->poster)
                        <div style="width:100%; aspect-ratio:16/9; overflow:hidden;">
                            <img src="{{ asset('storage/' . $activeWave->poster) }}" alt="{{ $activeWave->nama }}"
                                style="width:100%; height:100%; object-fit:cover; display:block;">
                        </div>
                    @endif

                    <div class="p-4">
                        @php $isOpen = $activeWave->isOpen(); @endphp

                        @if ($isOpen)
                            <span class="badge bg-success mb-3">Gelombang Aktif</span>
                        @else
                            @if (now()->lt($activeWave->tanggal_mulai))
                                <span class="badge bg-info mb-3">Aktif — Belum Dimulai</span>
                            @elseif (now()->gt($activeWave->tanggal_selesai))
                                <span class="badge bg-secondary mb-3">Aktif — Telah Berakhir</span>
                            @else
                                <span class="badge bg-warning mb-3">Aktif</span>
                            @endif
                        @endif

                        <h2 class="fw-bold mb-3">{{ $activeWave->nama }}</h2>
                        <p class="mb-3"><strong>Periode:</strong> {{ $activeWave->format_tanggal }}</p>

                        @if ($isOpen)
                            <p class="text-success mb-4">Pendaftaran sedang dibuka sekarang. Segera daftar sebelum gelombang berakhir.</p>
                        @elseif (now()->lt($activeWave->tanggal_mulai))
                            <p class="text-info mb-4">Pendaftaran belum dimulai. Dimulai pada {{ $activeWave->tanggal_mulai->translatedFormat('d F Y H:i') }}.</p>
                        @else
                            <p class="text-muted mb-4">Gelombang ini telah berakhir pada {{ $activeWave->tanggal_selesai->translatedFormat('d F Y H:i') }}.</p>
                        @endif

                        @if ($activeWave->deskripsi)
                            <div class="mb-4">
                                <h4 class="fw-semibold">Informasi PPDB</h4>
                                <p class="text-secondary">{{ $activeWave->deskripsi }}</p>
                            </div>
                        @endif

                        <div class="row gy-3">
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 h-100">
                                    <h5 class="fw-semibold">Langkah Pendaftaran</h5>
                                    <ul class="mb-0">
                                        <li>Isi formulir pendaftaran dengan mendatangi sekolah.</li>
                                        <li>Siapkan dokumen yang dibutuhkan.</li>
                                        <li>Ikuti tahapan seleksi sesuai jadwal.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 h-100">
                                    <h5 class="fw-semibold">Berkas yang Diperlukan</h5>
                                    <ul class="mb-0">
                                        <li>Foto copy akta kelahiran.</li>
                                        <li>Foto copy raport terakhir.</li>
                                        <li>Pas foto ukuran 3x4.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning">Belum ada gelombang PPDB aktif saat ini.</div>
        @endif

        @if ($upcomingWaves->isNotEmpty())
            <div class="mb-5">
                <h3 class="fw-semibold mb-3">Gelombang Mendatang</h3>
                <div class="list-group">
                    @foreach ($upcomingWaves as $wave)
                        <div class="list-group-item list-group-item-action rounded-4 mb-3 shadow-sm border-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="mb-1">{{ $wave->nama }}</h5>
                                    <p class="text-muted mb-1">{{ $wave->format_tanggal }}</p>
                                    <p class="mb-0 text-secondary">{{ Str::limit($wave->deskripsi, 140) }}</p>
                                </div>
                                @if ($wave->poster)
                                    <img src="{{ asset('storage/' . $wave->poster) }}" alt="{{ $wave->nama }}"
                                        class="rounded-3" style="width: 120px; height: 80px; object-fit: cover;">
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($pastWaves->isNotEmpty())
            <div class="mb-5">
                <h3 class="fw-semibold mb-3">Gelombang Sebelumnya</h3>
                <div class="list-group">
                    @foreach ($pastWaves as $wave)
                        <div class="list-group-item list-group-item-action rounded-4 mb-3 shadow-sm border-0">
                            <h5 class="mb-1">{{ $wave->nama }}</h5>
                            <p class="text-muted mb-1">{{ $wave->format_tanggal }}</p>
                            <p class="mb-0 text-secondary">{{ Str::limit($wave->deskripsi, 140) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
