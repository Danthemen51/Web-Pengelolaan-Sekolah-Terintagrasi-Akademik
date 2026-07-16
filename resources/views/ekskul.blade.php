@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center fw-bold mb-5">Ekstrakurikuler Sekolah</h2>

    <div class="row">
        @forelse($ekskuls as $ekskul)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 15px; overflow: hidden;">
                    <div class="row g-0 h-100">
                        <div class="col-md-5 bg-light d-flex align-items-center justify-content-center">
                            @if ($ekskul->image_url)
                                <img src="{{ $ekskul->image_url }}" class="img-fluid w-100 h-100"
                                    alt="{{ $ekskul->name }}"
                                    style="object-fit: cover; min-height: 200px;">
                            @else
                                <div class="text-center text-muted p-4">
                                    <i class="bi bi-image fs-1 d-block mb-2"></i>
                                    <small>Belum ada foto</small>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h4 class="fw-bold text-primary">{{ $ekskul->name }}</h4>
                                <p class="card-text text-muted mb-2">{{ $ekskul->description }}</p>
                                
                                <ul class="list-unstyled small">
                                    <li><strong><i class="bi bi-person-badge"></i> Pembina:</strong> {{ $ekskul->coach ?? '-' }}</li>
                                    <li><strong><i class="bi bi-clock"></i> Jadwal:</strong> {{ $ekskul->schedule ?? '-' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <p>Belum ada data ekstrakurikuler.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection