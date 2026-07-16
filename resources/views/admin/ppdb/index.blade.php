<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Gelombang PPDB</title>
</head>

<body>
    @include('partial.navbar_admin')

    <div class="main-content p-4">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 class="mb-1">Kelola Gelombang PPDB</h2>
                    <p class="text-muted small mb-0">
                        Atur gelombang penerimaan siswa baru dan upload poster untuk ditampilkan di halaman PPDB.
                    </p>
                </div>
                <a href="{{ route('admin.ppdb.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Gelombang
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($waves->isEmpty())
                <div class="alert alert-info">
                    Belum ada gelombang PPDB. <a href="{{ route('admin.ppdb.create') }}">Buat gelombang baru</a>
                </div>
            @else
                <div class="row g-3">
                    @foreach ($waves as $wave)
                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-3">
                                        <div>
                                            <h5 class="card-title mb-1">{{ $wave->nama }}</h5>
                                            <small class="text-muted d-block mb-2">
                                                {{ $wave->format_tanggal }}
                                            </small>
                                        </div>
                                        <span class="badge bg-{{ $wave->is_active ? 'success' : 'secondary' }}">
                                            {{ $wave->is_active ? 'AKTIF' : 'NONAKTIF' }}
                                        </span>
                                    </div>

                                    @if ($wave->deskripsi)
                                        <p class="card-text text-muted small mb-3">
                                            {{ Str::limit($wave->deskripsi, 100) }}
                                        </p>
                                    @endif

                                    @if ($wave->poster)
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $wave->poster) }}"
                                                alt="{{ $wave->nama }}"
                                                class="img-thumbnail w-100"
                                                style="max-height: 150px; object-fit: cover;">
                                        </div>
                                    @else
                                        <div class="mb-3 p-3 bg-light text-center text-muted rounded">
                                            <small>Belum ada poster</small>
                                        </div>
                                    @endif

                                    <div class="d-flex gap-2 flex-wrap">
                                        @if (!$wave->is_active)
                                            <form action="{{ route('admin.ppdb.toggle', $wave) }}" method="POST" class="d-inline">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success"
                                                    title="Aktifkan gelombang ini">
                                                    <i class="fas fa-check"></i> Aktifkan
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.ppdb.toggle', $wave) }}" method="POST" class="d-inline">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-warning"
                                                    title="Nonaktifkan gelombang ini">
                                                    <i class="fas fa-pause"></i> Nonaktifkan
                                                </button>
                                            </form>
                                        @endif

                                        <a href="{{ route('admin.ppdb.edit', $wave) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <form action="{{ route('admin.ppdb.destroy', $wave) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Hapus gelombang ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</body>

</html>
