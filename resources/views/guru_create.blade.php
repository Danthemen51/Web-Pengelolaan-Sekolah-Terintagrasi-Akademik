@extends('layouts.app')

@section('title', 'Tambah Data Guru')

@push('styles')
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
@endpush

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- CARD FORM --}}
            <div class="card shadow border-0 mb-5" style="border-radius: 15px;">
                <div class="card-header bg-primary text-white p-3" style="border-radius: 15px 15px 0 0;">
                    <h5 class="mb-0">Tambah Data Guru</h5>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('guru.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Guru / Staff</label>
                            <input type="text" name="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama') }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">NUPTK</label>
                                <input type="text" name="nuptk" class="form-control"
                                    value="{{ old('nuptk') }}" placeholder="16 digit">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jabatan</label>
                                <input type="text" name="jabatan" class="form-control"
                                    placeholder="Contoh: Guru Matematika" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="PNS">PNS</option>
                                    <option value="PPPK">PPPK</option>
                                    <option value="Honorer">Honorer</option>
                                    <option value="GTY">GTY</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tahun Mulai Tugas</label>
                                <input type="number" name="tahun_mulai" class="form-control"
                                    placeholder="Contoh: 2015" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto Profil</label>
                            <input type="file" name="foto" class="form-control">
                            <small class="text-muted">Format: jpg, png, jpeg. Maks: 2MB</small>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">Simpan Data Guru</button>
                            <a href="{{ route('guru.create') }}" class="btn btn-light">Batal</a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- CARD TABEL --}}
            <div class="card shadow border-0 p-4" style="border-radius: 15px;">
                <h3 class="fw-bold mb-4 text-dark">Data Guru & Staff</h3>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>NIP</th>
                                <th>NUPTK</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Jabatan</th>
                                <th>Tahun Mulai</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->nip ?? '-' }}</td>
                                    <td>{{ $item->nuptk ?? '-' }}</td>
                                    <td class="fw-bold">{{ $item->nama }}</td>
                                    <td><span class="badge bg-info text-dark">{{ $item->status }}</span></td>
                                    <td>{{ $item->jabatan }}</td>
                                    <td>{{ $item->tahun_mulai }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('guru.edit', $item->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('guru.destroy', $item->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-danger">
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
</div>
@endsection