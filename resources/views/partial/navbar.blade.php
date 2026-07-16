<style>
    .navbar-custom {
        background-color: #87cefa !important;
        padding: 0 !important;
        border-bottom: 2px solid rgba(0, 0, 0, 0.1);
    }

    .brand-container {
        background: linear-gradient(to right,
                #dc3545 0%,
                #dc3545 70%,
                #ffc107 90%,
                #87cefa 100%);
        padding: 10px 20px;
        display: flex;
        align-items: center;
        flex-shrink: 1;
    }

    .navbar-custom .nav-link,
    .navbar-custom .brand-text,
    .navbar-custom .navbar-brand {
        color: #ffffff !important;
    }

    .navbar-custom .nav-link:hover {
        background-color: #dc3545;
        border-bottom: 5px solid #ffc107;
        border-radius: 10px;
        color: #ffffff;
        transition: 0.3s;
    }

    .brand-container {
        align-items: center;
        background: linear-gradient(to right, 
                #dc3545 0%, 
                #dc3545 70%, 
                #ffc107 90%, 
                #87cefa 100%);
        padding: 10px 15px;
        flex-shrink: 1; 
    }

    @media (max-width: 991.98px) {
        .brand-text {
            font-size: 0.85rem;
            line-height: 1.2;
            display: inline-block;
        }

        .navbar-brand {
            margin-right: 10px !important;
        }

        .navbar-toggler {
            padding: 4px 8px;
            font-size: 1rem;
            flex-shrink: 0;
        }
    }
</style>

<nav class="navbar sticky-top navbar-expand-lg navbar-custom shadow-sm">
    <div class="container-fluid px-0">

        <div class="brand-container">
            <a class="navbar-brand fw-bold d-flex align-items-center me-5" href="/">
                <img src="{{ asset('images/logo_bib.png') }}" alt="Logo" width="40" height="40"
                    class="d-inline-block align-text-top me-2">
                <span class="brand-text me-2">SMK Binsa Insan Bangsa</span>
            </a>
        </div>

        <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse px-3 px-lg-5" id="navbarNav">
            <ul class="navbar-nav ms-auto fw-semibold" style="gap: 1rem">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown">Profil</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('visimisi') }}">Visi & Misi</a></li>
                        <li><a class="dropdown-item" href="{{ route('struktur_organisasi') }}">Struktur Organisasi</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('guru.public') }}">Guru & Staff</a></li>
                        <li><a class="dropdown-item" href="{{ route('fasilitas') }}">Fasilitas</a></li>
                        <li><a class="dropdown-item" href="{{ route('ekstrakurikuler') }}">Ekstrakurikuler</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="{{ route('program_keahlian') }}" class="nav-link">Program Keahlian</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('gallery') }}">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('ppdb') }}">PPDB</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('kontak') }}">Kontak</a></li>
                <li class="nav-item"><a href="{{ route('sesi.index') }}" class="nav-link">Akademik</a></li>
            </ul>
        </div>
    </div>
</nav>
