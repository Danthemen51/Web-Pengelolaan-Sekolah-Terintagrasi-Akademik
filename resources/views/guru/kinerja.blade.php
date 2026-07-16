<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kinerja Guru</title>
</head>
<body>
    @include('partial.navbar_guru')

    <div class="container py-4">
        <h2 class="fw-bold mb-1">Penilaian Kinerja Saya</h2>
        <p class="text-muted small mb-4">
            Berdasarkan kuisioner siswa (tabel <code>jawaban</code>) untuk guru
            <strong>{{ $guru?->nama ?? Auth::user()->name }}</strong>
            @if($kinerja['tahun_ajaran'] ?? null) — {{ $kinerja['tahun_ajaran'] }} @endif
        </p>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Skor Rata-rata</h6>
                        <h1 class="display-4 text-primary">
                            {{ $kinerja['rata_keseluruhan'] ?? '—' }}
                            @if($kinerja['rata_keseluruhan'])<small class="fs-6 text-muted">/ 5</small>@endif
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Jumlah Siswa Responden</h6>
                        <h1 class="display-4 text-success">{{ $kinerja['total_responden'] }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white fw-bold">Per Pertanyaan Kuisioner</div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Pertanyaan</th>
                                <th width="120">Rata-rata</th>
                                <th width="100">Respon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kinerja['per_pertanyaan'] as $row)
                                <tr>
                                    <td>{{ $row['pertanyaan'] }}</td>
                                    <td>
                                        @if ($row['rata'])
                                            <span class="badge bg-primary">{{ $row['rata'] }} / 5</span>
                                        @else
                                            <span class=”text-muted”>—</span>
                                        @endif
                                    </td>
                                    <td>{{ $row['jumlah'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        Belum ada pertanyaan kuisioner aktif atau belum ada penilaian.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

