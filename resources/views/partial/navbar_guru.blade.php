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
        <a class="navbar-brand fw-bold" href="{{ route('guru.dashboard') }}">Portal Guru</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarGuru">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarGuru">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guru.dashboard') ? 'active fw-semibold' : '' }}"
                        href="{{ route('guru.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guru.input.nilai') ? 'active fw-semibold' : '' }}"
                        href="{{ route('guru.input.nilai') }}">Input Nilai</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guru.kinerja') ? 'active fw-semibold' : '' }}"
                        href="{{ route('guru.kinerja') }}">Kinerja Saya</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Website</a>
                </li>
                <li class="nav-item ms-lg-2">
                    <span class="navbar-text text-white-50 small d-none d-lg-inline">{{ Auth::user()->name }}</span>
                </li>
                <li class="nav-item ms-lg-2">
                    <a href="{{ route('guru.logout') }}" class="btn btn-danger btn-sm"
                        onclick="event.preventDefault(); if(confirm('Keluar?')) document.getElementById('logout-guru-form').submit();">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<form id="logout-guru-form" action="{{ route('guru.logout') }}" method="POST" class="d-none">@csrf</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
