<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Ekstrakurikuler</title>
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

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
                position: relative;
            }

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
                            <h5 class="mb-0">Tambah Ekstrakurikuler</h5>
                        </div>
                        <div class="card-body p-4">
                            <h3>Tambah Ekstrakurikuler</h3>
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
                            <form action="/tambah-ekskul" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="text" name="name" placeholder="Nama Ekskul" required
                                    style="width: 100%; margin-bottom: 10px;">

                                <label>Foto Ekskul:</label>
                                <input type="file" name="image" required style="margin-bottom: 10px;">

                                <input type="text" name="coach" placeholder="Nama Pembina"
                                    style="width: 100%; margin-bottom: 10px;">
                                <input type="text" name="schedule" placeholder="Jadwal (Contoh: Jumat, 15:00)"
                                    style="width: 100%; margin-bottom: 10px;">

                                <textarea name="description" placeholder="Deskripsi ekskul..." rows="3" style="width: 100%; margin-bottom: 10px;"></textarea>

                                <button type="submit" class="btn"
                                    style="background-color: #e67e22; color: white; padding: 10px 20px; border: none; cursor: pointer;">Simpan
                                    Ekskul</button>
                                <a href="{{ route('ekskul.create') }}" class="btn btn-light mt-2">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow border-0 p-4" style="border-radius: 15px;">
            <h3 class="fw-bold mb-4 text-dark">Daftar Ekstrakurikuler</h3>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Pembina</th>
                            <th>Jadwal</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ekskuls as $item)
                            <tr>
                                <td>
                                    @if ($item->image_url)
                                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}"
                                            class="rounded" style="width: 56px; height: 56px; object-fit: cover;">
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->coach }}</td>
                                <td>{{ $item->schedule }}</td>
                                <td>{{ $item->description }}</td>
                                <td class="text-center">
                                    <a href="{{ route('ekskul.edit', $item->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('ekskul.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus ekskul ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
