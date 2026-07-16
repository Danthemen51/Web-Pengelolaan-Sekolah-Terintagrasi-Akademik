<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('partial.navbar_admin')

    <div class="main-content">
        <div class="container py-5">
            <div class="card shadow border-0 p-4">
                <h3 class="fw-bold">Edit Berita: {{ $news->title }}</h3>
                <hr>
                <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label>Judul Berita:</label>
                    <input type="text" name="title" id="title" value="{{ $news->title }}"
                        class="form-control mb-3" required>

                    <label>Slug (Otomatis):</label>
                    <input type="text" name="slug" id="slug" value="{{ $news->slug }}"
                        class="form-control mb-3" required>

                    <label>Foto Berita (Kosongkan jika tidak diganti):</label>
                    @if ($news->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $news->image) }}" width="100">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control mb-3">

                    <label>Ringkasan:</label>
                    <textarea name="excerpt" rows="2" class="form-control mb-3">{{ $news->excerpt }}</textarea>

                    <label>Isi Berita:</label>
                    <textarea name="content" rows="5" class="form-control mb-3">{{ $news->content }}</textarea>

                    <label>Penulis:</label>
                    <input type="text" name="author" value="{{ $news->author }}" class="form-control mb-3">

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('news.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');
        title.addEventListener('keyup', function() {
            let preslug = title.value;
            preslug = preslug.replace(/[^a-zA-Z0-9\s]/g, "");
            preslug = preslug.replace(/\s+/g, "-");
            slug.value = preslug.toLowerCase();
        });
    </script>
</body>

</html>
