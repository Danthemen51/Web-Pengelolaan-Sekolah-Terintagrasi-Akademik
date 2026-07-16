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
            <div class="card shadow border-0 p-4">
                <h3>Edit Guru: {{ $guru->nama }}</h3>
                <hr>
                <form action="{{ route('guru.update', $guru->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label>Nama:</label>
                    <input type="text" name="nama" id="nama" value="{{ $guru->nama }}"
                        class="form-control mb-3" required>

                    <label>NUPTK:</label>
                    <input type="text" name="nuptk" id="nuptk" value="{{ $guru->nuptk }}"
                        class="form-control mb-3" placeholder="16 digit">

                    <label>Jabatan:</label>
                    <input type="text" name="jabatan" id="jabatan" value="{{ $guru->jabatan }}"
                        class="form-control mb-3" required>

                    <label>Status:</label>
                    <select name="status" id="status" class="form-control mb-3" required>
                        <option value="PNS" {{ $guru->status == 'PNS' ? 'selected' : '' }}>PNS</option>
                        <option value="PPPK" {{ $guru->status == 'PPPK' ? 'selected' : '' }}>PPPK</option>
                        <option value="Honorer" {{ $guru->status == 'Honorer' ? 'selected' : '' }}>Honorer</option>
                        <option value="GTY" {{ $guru->status == 'GTY' ? 'selected' : '' }}>GTY</option>
                    </select>

                    <label>Tahun Mulai:</label>
                    <input type="number" name="tahun_mulai" id="tahun_mulai" value="{{ $guru->tahun_mulai }}"
                        class="form-control mb-3" required>

                    <label>Foto Guru (Kosongkan jika tidak diganti):</label>
                    @if ($guru->foto)
                        <div class="mb-2">
                            <img src="{{ asset('foto_guru/' . $guru->foto) }}" width="100">
                        </div>
                    @endif
                    <input type="file" name="foto" class="form-control mb-3">

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
