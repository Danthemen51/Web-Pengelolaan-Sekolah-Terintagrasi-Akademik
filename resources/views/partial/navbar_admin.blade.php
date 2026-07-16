<head>
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
<nav class="navbar navbar-dark bg-dark d-lg-none p-3">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold">Menu Admin</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
            aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="sidebar collapse d-lg-block bg-dark text-white p-3" id="sidebarMenu">
    <div class="d-flex flex-column">
        <span class="fw-bold mb-3 d-none d-lg-block">Halo, {{ Auth::user()->name }}</span>
        <hr class="d-none d-lg-block">

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="btn-custom">Home</a></li>
            <li><a href="{{ route('admin.mapping') }}" class="btn-custom">Mapping Pembelajaran</a></li>
            <li><a href="{{ route('kelas.index') }}" class="btn-custom">Kelola Kelas</a></li>
            <li><a href="{{ route('siswa.create') }}" class="btn-custom">Kelola Siswa</a></li>
            <li><a href="{{ route('admin.pengumuman.create') }}" class="btn-custom">Tambah Pengumuman</a></li>
            <li><a href="{{ route('admin.ppdb.index') }}" class="btn-custom">Kelola PPDB</a></li>
            <li><a href="{{ route('admin.users.create') }}" class="btn-custom">Tambah User</a></li>
            <li><a href="{{ route('guru.create') }}" class="btn-custom">Tambah Guru Baru</a></li>
            <li><a href="{{ route('ekskul.create') }}" class="btn-custom">Tambah Ekskul Baru</a></li>
            <li><a href="{{ route('news.create') }}" class="btn-custom">Tambah Berita Baru</a></li>
            <li><a href="{{ route('gallery.create') }}" class="btn-custom">Tambah Foto Baru</a></li>
            <li><a href="{{ route('admin.program_photos.index') }}" class="btn-custom">Foto Kegiatan Jurusan</a></li>

            <li class="mt-3">
                <hr>
                <a href="{{ route('logout') }}" class="btn-custom text-danger"
                    onclick="event.preventDefault(); if(confirm('Keluar?')) document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </li>
        </ul>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
