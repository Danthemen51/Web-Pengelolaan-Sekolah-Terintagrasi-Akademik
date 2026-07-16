<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuisioner Penilaian Kinerja Guru</title>
</head>
<body>
    @include('partial.navbar_siswa')

    <div class="container py-4">
        <h2 class="fw-bold mb-1">Kuisioner Penilaian Kinerja Guru</h2>
        <p class="text-muted small mb-4">
            Kelas: <strong>{{ $siswa->kelas?->label ?? '-' }}</strong>
            &mdash; Hanya guru yang mengajar di kelas Anda (dari <code>guru_mapel</code>).
            @if($tahunAjaran) &middot; {{ $tahunAjaran->nama }} @endif
        </p>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        @if ($guruList->isEmpty())
            <div class="alert alert-warning">Belum ada guru yang ditugaskan di kelas Anda.</div>
        @elseif ($pertanyaan->isEmpty())
            <div class="alert alert-warning">Belum ada pertanyaan kuisioner aktif.</div>
        @else
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="{{ route('kuisioner.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Pilih Guru yang Dinilai</label>
                            <select name="guru_id" class="form-select" required>
                                <option value="">-- Pilih guru --</option>
                                @foreach ($guruList as $g)
                                    @php $sudah = in_array($g->id, $sudahDinilai); @endphp
                                    <option value="{{ $g->id }}" @disabled($sudah)>
                                        {{ $g->nama_lengkap }}
                                        @if($sudah) (sudah dinilai) @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <hr>
                        <p class="small text-muted mb-3">Skala 1 (sangat kurang) s/d 5 (sangat baik)</p>

                        @foreach ($pertanyaan as $p)
                            <div class="mb-4 p-3 bg-light rounded">
                                <p class="fw-semibold mb-2">{{ $loop->iteration }}. {{ $p->pertanyaan }}</p>
                                <div class="d-flex flex-wrap gap-3">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input me-1"
                                                name="nilai[{{ $p->id }}]" value="{{ $i }}" required>
                                            {{ $i }}
                                        </label>
                                    @endfor
                                </div>
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-success">Kirim Penilaian</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</body>
</html>