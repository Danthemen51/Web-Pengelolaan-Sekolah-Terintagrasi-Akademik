<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gelombang PPDB</title>
</head>

<body>
    @include('partial.navbar_admin')

    <div class="main-content p-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <h2 class="mb-1">Tambah Gelombang PPDB</h2>
                    <p class="text-muted small mb-4">
                        Buat gelombang baru untuk penerimaan siswa dengan poster yang menarik.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <form action="{{ route('admin.ppdb.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Gelombang</label>
                                    <input type="text" name="nama" class="form-control" required
                                        placeholder="Contoh: Gelombang 1, Gelombang 2"
                                        value="{{ old('nama') }}">
                                    <small class="text-muted">Nama yang akan ditampilkan pada halaman PPDB</small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Deskripsi (Opsional)</label>
                                    <textarea name="deskripsi" class="form-control" rows="3"
                                        placeholder="Tambahkan informasi tambahan tentang gelombang ini">{{ old('deskripsi') }}</textarea>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Tanggal Mulai</label>
                                        <input type="datetime-local" name="tanggal_mulai" class="form-control" required
                                            value="{{ old('tanggal_mulai') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Tanggal Selesai</label>
                                        <input type="datetime-local" name="tanggal_selesai" class="form-control" required
                                            value="{{ old('tanggal_selesai') }}">
                                        <small class="text-muted">Harus setelah tanggal mulai</small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Poster/Gambar</label>
                                    <input type="file" name="poster" class="form-control" accept="image/*">
                                    <small class="text-muted">
                                        Format: JPG, PNG, GIF. Ukuran maksimal: 5MB. Rekomendasi: 1200x600px
                                    </small>

                                    @if (old('poster'))
                                        <div class="mt-2 alert alert-info">
                                            Preview akan ditampilkan setelah upload
                                        </div>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="isActive" name="is_active"
                                            {{ old('is_active') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="isActive">
                                            <strong>Aktifkan gelombang ini sekarang</strong>
                                            <br>
                                            <small class="text-muted">
                                                Hanya satu gelombang yang dapat aktif dalam satu waktu
                                            </small>
                                        </label>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan Gelombang
                                    </button>
                                    <a href="{{ route('admin.ppdb.index') }}" class="btn btn-outline-secondary">
                                        Batal
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
