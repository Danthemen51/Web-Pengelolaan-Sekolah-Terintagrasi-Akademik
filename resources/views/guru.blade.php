@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Daftar Pendidik & Tenaga Kependidikan</h2>
            <p class="text-muted">SMK Bina Insan Bangsa</p>
            <hr style="width: 80px; margin: auto; border: 2px solid #007bff;">
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse($dataGuru as $guru)
                <div class="col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0 text-center p-3" style="border-radius: 20px;">
                        <div class="mt-3">
                            @if ($guru->foto)
                                <img src="{{ asset('foto_guru/' . $guru->foto) }}" class="rounded-circle shadow-sm"
                                    style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #f8f9fa;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($guru->nama) }}&background=random"
                                    class="rounded-circle" style="width: 120px; height: 120px;">
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-1">{{ $guru->nama }}</h5>
                            <p class="text-primary small mb-2">{{ $guru->jabatan }}</p>

                            <div class="bg-light rounded-pill py-1 px-3 d-inline-block mb-3">
                                <span class="small text-muted">NUPTK: {{ $guru->nuptk ?? '-' }}</span>
                            </div>

                            <div class="d-flex justify-content-between border-top pt-3 mt-2">
                                <div class="text-start">
                                    <small class="text-muted d-block">Status</small>
                                    <span class="badge bg-info text-dark">{{ $guru->status }}</span>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted d-block">Mulai Tugas</small>
                                    <span class="fw-bold">{{ $guru->tahun_mulai }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada data guru yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
