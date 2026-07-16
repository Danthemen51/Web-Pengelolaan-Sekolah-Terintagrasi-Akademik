<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Data Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
        }

        .btn-custom {
            display: block;
            width: 100%;
            padding: 10px 15px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 5px;
        }

        /* Sidebar Desktop */
        @media (min-width: 992px) {
            .sidebar {
                width: 250px;
                height: 100vh;
                position: fixed;
                left: 0;
                top: 0;
                z-index: 1000;
            }

            .main-content {
                margin-left: 250px;
            }
        }

        /* Sidebar Mobile */
        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
                position: relative;
            }

            /* Menghapus paksaan !important agar JS Bootstrap bisa bekerja */
            .sidebar.collapse:not(.show) {
                display: none;
            }
        }
    </style>
</head>

<body>
    @include('partial.navbar_admin')

    <div class="main-content">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow border-0" style="border-radius: 15px;">
                        <div class="card-header bg-primary text-white" style="border-radius: 15px 15px 0 0;">
                            <h5 class="mb-0 text-center">Tambah Berita</h5>
                        </div>
                        <div class="card-body p-4">
                            @if ($errors->any())
                                <div
                                    style="background: #fee2e2; color: #991b1b; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                                    <strong>Ups! Ada masalah:</strong>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('success'))
                                <div
                                    style="background: #dcfce7; color: #166534; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="text" name="title" id="title" placeholder="Judul Berita" required
                                    style="width: 100%; margin-bottom: 10px;">

                                <input type="text" name="slug" id="slug" placeholder="slug-berita-otomatis"
                                    required style="width: 100%; margin-bottom: 10px;">

                                <label for="image">Foto Berita:</label>
                                <input type="file" name="image" id="image" style="margin-bottom: 10px;">

                                <textarea name="excerpt" placeholder="Ringkasan berita (untuk halaman utama)" rows="2"
                                    style="width: 100%; margin-bottom: 10px;"></textarea>

                                <textarea name="content" placeholder="Isi berita lengkap..." rows="5" style="width: 100%; margin-bottom: 10px;"></textarea>

                                <input type="text" name="author" placeholder="Nama Penulis (default: Admin)"
                                    style="width: 100%; margin-bottom: 10px;">

                                <button type="submit"
                                    style="background-color: blue; color: white; padding: 10px 20px; border: none; cursor: pointer;">Terbitkan
                                    Berita</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow border-0 p-4 mt-5" style="border-radius: 15px;">
                <h3 class="fw-bold mb-4 text-dark">Daftar Berita</h3>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Ringkasan</th>
                                <th>Isi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->author }}</td>
                                    <td>{{ $item->excerpt }}</td>
                                    <td>{{ $item->content }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td class="text-center">
                                        {{-- <a href="/berita/{{ $item->slug }}" target="_blank"
                                            class="btn btn-sm btn-info text-white">Lihat</a>
                                        | --}}
                                        <a href="{{ route('news.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('news.destroy', $item->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
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
