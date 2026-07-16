<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .bg-navy { background-color: #1e3a5f !important; }
    </style>
</head>
<nav class="navbar navbar-expand-lg bg-navy navbar-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('siswa.dashboard') }}">Portal Siswa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSiswa">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSiswa">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('siswa.dashboard') ? 'active fw-semibold' : '' }}"
                        href="{{ route('siswa.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('siswa.nilai') ? 'active fw-semibold' : '' }}"
                        href="{{ route('siswa.nilai') }}">Nilai Saya</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kuisioner.*') ? 'active fw-semibold' : '' }}"
                        href="{{ route('kuisioner.index') }}">Kuisioner Guru</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Website</a>
                </li>
                <li class="nav-item ms-lg-2">
                    <span class="navbar-text text-white-50 small d-none d-lg-inline">{{ Auth::user()->name }}</span>
                </li>
                <li class="nav-item ms-lg-2">
                    <a href="{{ route('siswa.logout') }}" class="btn btn-danger btn-sm"
                        onclick="event.preventDefault(); if(confirm('Keluar?')) document.getElementById('logout-siswa-form').submit();">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<form id="logout-siswa-form" action="{{ route('siswa.logout') }}" method="POST" class="d-none">@csrf</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

