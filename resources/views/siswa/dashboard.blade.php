<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
</head>
<body>
    @include('partial.navbar_siswa')

    <div class="container py-4">
        @if ($siswa)
            <div class="alert alert-info py-2">
                Kelas Anda: <strong>{{ $siswa->kelas?->label ?? $siswa->kelas?->nama ?? '-' }}</strong>
            </div>
        @else
            <div class="alert alert-warning">Anda belum ditempatkan di kelas. Hubungi admin.</div>
        @endif

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5>Nilai Saya</h5>
                        <p class="text-muted small">Lihat nilai dari guru sesuai mapel &amp; penugasan.</p>
                        <a href="{{ route('siswa.nilai') }}" class="btn btn-primary">Lihat Nilai</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5>Kuisioner Guru</h5>
                        <p class="text-muted small">Nilai kinerja guru yang mengajar di kelas Anda.</p>
                        <a href="{{ route('kuisioner.index') }}" class="btn btn-success">Isi Kuisioner</a>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="fw-bold mb-2">Pengumuman</h4>
        <p class="text-muted small">Pengumuman untuk <strong>siswa</strong> dan <strong>semua</strong>.</p>

        <div class="row g-3">
            @forelse ($pengumuman as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <span class="badge bg-{{ $item->target === 'siswa' ? 'success' : 'secondary' }} mb-2">{{ ucfirst($item->target) }}</span>
                            <h5 class="card-title">{{ $item->judul }}</h5>
                            <p class="small text-muted">{{ Str::limit($item->isi, 100) }}</p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button type="button" class="btn btn-sm btn-outline-primary w-100"
                                onclick="showPengumuman(@json($item->judul), @json($item->isi))">Baca selengkapnya</button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-muted text-center py-4">Belum ada pengumuman.</div>
            @endforelse
        </div>
    </div>

    @include('partial.modal_pengumuman')
</body>
</html>