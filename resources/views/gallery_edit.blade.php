<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Foto Gallery</title>
</head>

<body>
    @include('partial.navbar_admin')

    <div class="main-content p-4">
        <div class="container-fluid">
            <h2 class="mb-3">Edit Foto</h2>

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
                            <h5 class="mb-0">{{ $galleries->title }}</h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('gallery.update', $galleries->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Judul Foto</label>
                                    <input type="text" name="title" value="{{ old('title', $galleries->title) }}"
                                        class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto Kegiatan</label>
                                    @if ($galleries->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $galleries->image) }}"
                                                alt="{{ $galleries->title }}" class="img-thumbnail"
                                                style="max-height: 200px;">
                                        </div>
                                    @endif
                                    <input type="file" name="image" class="form-control"
                                        accept="image/jpeg,image/png,image/jpg">
                                    <div class="form-text">Kosongkan jika tidak ingin mengganti foto.</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea name="description" class="form-control" rows="3">{{ old('description', $galleries->description) }}</textarea>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <a href="{{ route('gallery.create') }}" class="btn btn-secondary">Batal</a>
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

