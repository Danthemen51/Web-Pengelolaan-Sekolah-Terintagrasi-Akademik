<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengumuman</title>
</head>

<body>
    @include('partial.navbar_admin')

    <div class="main-content p-4">
        <div class="container-fluid">
            <h2 class="mb-3">Edit Pengumuman</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">{{ $pengumuman->judul }}</h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('admin.pengumuman.update', $pengumuman) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Judul</label>
                                    <input type="text" name="judul" class="form-control"
                                        value="{{ old('judul', $pengumuman->judul) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Isi Pengumuman</label>
                                    <textarea name="isi" class="form-control" rows="5"
                                        required>{{ old('isi', $pengumuman->isi) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Ditujukan Untuk</label>
                                    <select name="target" class="form-select" required>
                                        <option value="guru" @selected(old('target', $pengumuman->target) === 'guru')>Guru</option>
                                        <option value="siswa" @selected(old('target', $pengumuman->target) === 'siswa')>Siswa</option>
                                        <option value="semua" @selected(old('target', $pengumuman->target) === 'semua')>Semua</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tanggal Berakhir <span class="text-muted">(opsional)</span></label>
                                    <input type="date" name="expired_at" class="form-control"
                                        value="{{ old('expired_at', $pengumuman->expired_at?->format('Y-m-d')) }}">
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-secondary">Batal</a>
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

