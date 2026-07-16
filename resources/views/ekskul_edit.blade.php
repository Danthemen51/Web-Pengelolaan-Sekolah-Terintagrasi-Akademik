<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Ekstrakurikuler</title>
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
            <div class="card shadow border-0 p-4">
                <h3>Edit Ekskul: {{ $ekskuls->name }}</h3>
                <hr>
                <form action="{{ route('ekskul.update', $ekskuls->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="fw-bold">Nama Ekstrakurikuler:</label>
                        <input type="text" name="name" value="{{ old('name', $ekskuls->name) }}"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Foto ekskul (Kosongkan jika tidak diganti):</label>
                        @if ($ekskuls->image_url)
                            <div class="mb-2">
                                <img src="{{ $ekskuls->image_url }}" width="150"
                                    class="img-thumbnail" alt="{{ $ekskuls->name }}">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Pembina:</label>
                        <input type="text" name="coach" value="{{ old('coach', $ekskuls->coach) }}"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Jadwal:</label>
                        <input type="text" name="schedule" value="{{ old('schedule', $ekskuls->schedule) }}"
                            class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Deskripsi:</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $ekskuls->description) }}</textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
