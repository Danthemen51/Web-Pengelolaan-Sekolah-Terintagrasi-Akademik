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

    <div class="main-content p-4">
        <h2 class="mb-4 fw-bold">Dashboard Admin</h2>

        {{-- Stat Cards --}}
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#0d6efd" viewBox="0 0 16 16">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1 small text-uppercase fw-semibold">Total Siswa</h6>
                            <h3 class="mb-0 fw-bold">{{ $totalSiswa }}</h3>
                            <small class="text-muted">Terdaftar di kelas</small>
                            <!-- <div class="mt-1">
                                <a href="{{ route('kelas.index') }}" class="small text-decoration-none">Lihat per kelas</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#198754" viewBox="0 0 16 16">
                                    <path d="M2.5 9a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm9 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm7 2a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                    <path d="M3.612 15.443c.386.21.853.344 1.337.37v-2.808l-2.36 1.792c-.33.196-.64.432-.932.674a2.12 2.12 0 0 1-.934-.674l-2.36-1.792v2.808c.484-.026 1.014-.16 1.338-.37l2.006-1.202a2.12 2.12 0 0 1 2.006 0z"/>
                                    <path d="M14.5 9a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1 small text-uppercase fw-semibold">Total Guru</h6>
                            <h3 class="mb-0 fw-bold">{{ $totalGuru }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#ffc107" viewBox="0 0 16 16">
                                    <path d="M6 8.5a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0z"/>
                                    <path d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                    <path d="M4.5 5.5A.5.5 0 0 1 5 5h.5a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
                                    <path d="M4.928 2.927 6 4.5l-1.072 1.573A1.5 1.5 0 0 1 4 6h-.5v3.5A1.5 1.5 0 0 0 5.5 11h5a1.5 1.5 0 0 0 1.5-1.5V5a1.5 1.5 0 0 0-1.5-1.5H7a1.5 1.5 0 0 1-1.072-.573z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1 small text-uppercase fw-semibold">Total Ekskul</h6>
                            <h3 class="mb-0 fw-bold">{{ $totalEkskul }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                    <div class="card-body d-flex align-items-center">
                        <div class="me-3">
                            <div class="bg-danger bg-opacity-10 rounded-3 p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#dc3545" viewBox="0 0 16 16">
                                    <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5z"/>
                                    <path d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1 small text-uppercase fw-semibold">Total Pengumuman</h6>
                            <h3 class="mb-0 fw-bold">{{ $totalPengumuman }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Pengumuman --}}
        @if($recentPengumuman->count() > 0)
        <div class="card border-0 shadow-sm" style="border-radius: 12px;">
            <div class="card-header bg-white border-0 py-3">
                <h5 class="mb-0 fw-bold">Pengumuman Terbaru</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">Judul</th>
                                <th class="px-4 py-3">Isi</th>
                                <th class="px-4 py-3">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPengumuman as $pengumuman)
                            <tr>
                                <td class="px-4 py-3 fw-semibold">{{ $pengumuman->judul }}</td>
                                <td class="px-4 py-3">{{ Str::limit($pengumuman->isi, 80) }}</td>
                                <td class="px-4 py-3 text-muted">{{ $pengumuman->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</body>
</html>