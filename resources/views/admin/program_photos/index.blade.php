<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Foto Kegiatan Jurusan</title>
</head>

<body>
    @include('partial.navbar_admin')

    <div class="main-content p-4">
        <div class="container-fluid">
            <h2 class="mb-1">Kelola Foto Kegiatan Jurusan</h2>
            <p class="text-muted small mb-4">
                Upload foto kegiatan untuk program keahlian (TJKT, BDP, TBSM).
                Foto akan ditampilkan di halaman Program Keahlian dan detail jurusan.
            </p>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row g-4">
                {{-- FORM UPLOAD --}}
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Upload Foto</h5>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('admin.program_photos.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Jurusan</label>
                                    <select name="jurusan" class="form-select" required>
                                        @foreach($jurusanList as $key => $label)
                                            <option value="{{ $key }}" @selected(old('jurusan', $jurusan) == $key)>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Caption (opsional)</label>
                                    <input type="text" name="caption" class="form-control"
                                        value="{{ old('caption') }}" placeholder="Deskripsi foto">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto</label>
                                    <input type="file" name="foto" class="form-control" accept="image/*" required>
                                    <div class="form-text">Format: jpg, png, jpeg. Maks: 5MB.</div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- DAFTAR FOTO --}}
                <div class="col-lg-8">
                    {{-- Filter Tab --}}
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Daftar Foto</h5>
                            <div class="d-flex gap-2">
                                @foreach($jurusanList as $key => $label)
                                    <a href="{{ route('admin.program_photos.index', ['jurusan' => $key]) }}"
                                        class="btn btn-sm @if($jurusan == $key) btn-primary @else btn-outline-primary @endif">
                                        {{ $label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                @if($photos->isEmpty())
                                    <div class="text-center text-muted py-5">
                                        <p class="mb-0">Belum ada foto untuk jurusan ini.</p>
                                        <small>Upload foto melalui form di samping.</small>
                                    </div>
                                @else
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="100">Preview</th>
                                                <th>Caption</th>
                                                <th width="140">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($photos as $photo)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('storage/' . $photo->foto) }}"
                                                            alt="{{ $photo->caption ?? 'Foto' }}"
                                                            class="img-thumbnail"
                                                            style="width:80px;height:60px;object-fit:cover;">
                                                    </td>
                                                    <td>{{ $photo->caption ?? '-' }}</td>
                                                    <td class="text-nowrap">
                                                        <form action="{{ route('admin.program_photos.destroy', $photo) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Hapus foto ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>