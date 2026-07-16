<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Foto Gallery</title>
</head>

<body>
    @include('partial.navbar_admin')

    <div class="main-content p-4">
        <div class="container-fluid">
            <h2 class="mb-3">Tambah Foto Baru</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Ups! Ada masalah:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Upload Foto Kegiatan</h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="/tambah-gallery" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Judul Foto</label>
                                    <input type="text" name="title" class="form-control" placeholder="Judul foto"
                                        value="{{ old('title') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="image_gallery" class="form-label">Foto Kegiatan</label>
                                    <input type="file" name="image" id="image_gallery" class="form-control"
                                        accept="image/jpeg,image/png,image/jpg" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea name="description" class="form-control" rows="3"
                                        placeholder="Deskripsi singkat foto...">{{ old('description') }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-success w-100">Simpan ke Gallery</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card shadow-sm border-0">
                        <div class="card-header">
                            <h5 class="mb-0">Daftar Foto</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Judul</th>
                                            <th>Deskripsi</th>
                                            <th width="140">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($galleries as $item)
                                            <tr>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ Str::limit($item->description, 50) }}</td>
                                                <td class="text-nowrap">
                                                    <a href="{{ route('gallery.edit', $item->id) }}"
                                                        class="btn btn-sm btn-outline-primary">Edit</a>
                                                    <form action="{{ route('gallery.destroy', $item->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-sm btn-outline-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-muted text-center py-4">Belum ada foto.
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
