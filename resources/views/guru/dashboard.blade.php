<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru</title>
</head>
<body>
    @include('partial.navbar_guru')

    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Rata-rata Kinerja</h6>
                        <h2 class="text-primary mb-0">
                            {{ $kinerja['rata_keseluruhan'] !== null ? $kinerja['rata_keseluruhan'] . '/5' : '—' }}
                        </h2>
                        <small class="text-muted">{{ $kinerja['tahun_ajaran'] ?? 'Tahun ajaran aktif' }}</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Responden Kuisioner</h6>
                        <h2 class="text-success mb-0">{{ $kinerja['total_responden'] }}</h2>
                        <small class="text-muted">Siswa yang sudah menilai</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <a href="{{ route('guru.kinerja') }}" class="btn btn-outline-primary">Lihat Detail Kinerja</a>
                        <a href="{{ route('guru.input.nilai') }}" class="btn btn-primary mt-2">Input Nilai Siswa</a>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="fw-bold mb-3">Pengumuman</h4>
        <p class="text-muted small">Menampilkan pengumuman untuk <strong>guru</strong> dan <strong>semua</strong>.</p>

        <div class="row g-3">
            @forelse ($pengumuman as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <span class="badge bg-{{ $item->target === 'guru' ? 'info' : 'secondary' }} mb-2">
                                {{ ucfirst($item->target) }}
                            </span>
                            <h5 class="card-title">{{ $item->judul }}</h5>
                            <p class="card-text small text-muted">{{ Str::limit($item->isi, 120) }}</p>
                            <small class="text-muted">
                                {{ $item->user?->name }} ·
                                {{ $item->expired_at ? 'Berakhir ' . $item->expired_at->format('d/m/Y') : 'Tanpa batas' }}
                            </small>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button type="button" class="btn btn-sm btn-outline-primary w-100"
                                onclick="showPengumuman(@json($item->judul), @json($item->isi))">
                                Baca selengkapnya
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-4">Belum ada pengumuman.</div>
            @endforelse
        </div>
    </div>

    @include('partial.modal_pengumuman')
</body>
</html>

