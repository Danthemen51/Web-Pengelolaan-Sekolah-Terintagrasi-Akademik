<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengumuman</title>
</head>

<body>
    @include('partial.navbar_admin')

    <div class="main-content p-4">
        <div class="container-fluid">
            <h2 class="mb-3">Tambah Pengumuman</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Buat Pengumuman Baru</h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('admin.pengumuman.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Judul</label>
                                    <input type="text" name="judul" class="form-control"
                                        value="{{ old('judul') }}" placeholder="Judul pengumuman" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Isi Pengumuman</label>
                                    <textarea name="isi" class="form-control" rows="5"
                                        placeholder="Tulis isi pengumuman..." required>{{ old('isi') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Ditujukan Untuk</label>
                                    <select name="target" class="form-select" required>
                                        <option value="">- Pilih -</option>
                                        <option value="guru" @selected(old('target') === 'guru')>Guru</option>
                                        <option value="siswa" @selected(old('target') === 'siswa')>Siswa</option>
                                        <option value="semua" @selected(old('target') === 'semua')>Semua</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tanggal Berakhir <span class="text-muted">(opsional)</span></label>
                                    <input type="date" name="expired_at" class="form-control"
                                        value="{{ old('expired_at') }}" min="{{ date('Y-m-d') }}">
                                    <div class="form-text">Kosongkan jika pengumuman tidak ada batas waktu.</div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Simpan Pengumuman</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card shadow-sm border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Daftar Pengumuman</h5>
                            <span class="badge bg-secondary">{{ $pengumuman->count() }}</span>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Judul</th>
                                            <th>Target</th>
                                            <th>Berakhir</th>
                                            <th width="140">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pengumuman as $item)
                                            <tr>
                                                <td>
                                                    <strong>{{ $item->judul }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ Str::limit($item->isi, 60) }}</small>
                                                </td>
                                                <td>
                                                    @php
                                                        $badge = match ($item->target) {
                                                            'guru' => 'bg-info',
                                                            'siswa' => 'bg-success',
                                                            default => 'bg-dark',
                                                        };
                                                    @endphp
                                                    <span class="badge {{ $badge }}">{{ ucfirst($item->target) }}</span>
                                                </td>
                                                <td class="small">
                                                    @if ($item->expired_at)
                                                        {{ $item->expired_at->format('d/m/Y') }}
                                                        @if ($item->expired_at->isPast())
                                                            <br><span class="text-danger">Kedaluwarsa</span>
                                                        @endif
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td class="text-nowrap">
                                                    <a href="{{ route('admin.pengumuman.edit', $item) }}"
                                                        class="btn btn-sm btn-outline-primary">Edit</a>
                                                    <form action="{{ route('admin.pengumuman.destroy', $item) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Hapus pengumuman ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-muted text-center py-4">Belum ada pengumuman.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

