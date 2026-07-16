@extends('layouts.app')

@section('content')
<div class="banner-berita">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-white">Galeri</h1>
        <p class="lead text-white-50">Dokumentasi momen dan prestasi SMK Bina Insan Bangsa</p>
    </div>
</div>

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Galeri Kegiatan Sekolah</h1>
        <p class="text-muted">Dokumentasi momen dan prestasi SMK Bina Insan Bangsa</p>
        <hr style="width: 100px; margin: auto; border: 2px solid #002D72;">
    </div>

    <div class="row g-4">
        @forelse($galleries as $gallery)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card h-100 border-0 shadow-sm gallery-card" 
                     onclick="showGallery('{{ addslashes($gallery->title) }}', '{{ $gallery->image }}', '{{ addslashes($gallery->description) }}')"
                     style="cursor: pointer; overflow: hidden; border-radius: 15px;">
                    
                    <div class="inner-img">
                        <img src="{{ asset('storage/' . $gallery->image) }}" 
                             class="card-img-top" 
                             alt="{{ $gallery->title }}"
                             style="height: 250px; object-fit: cover; transition: transform 0.3s ease;">
                    </div>
                    
                    <div class="card-body p-2 text-center">
                        <p class="card-text fw-semibold text-dark mb-0">{{ Str::limit($gallery->title, 40) }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada foto kegiatan.</p>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $galleries->links() }}
    </div>
</div>

<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <img id="galleryImg" src="" class="img-fluid rounded mb-3" style="max-height: 70vh; width: 100%; object-fit: contain;">
                <h4 id="galleryTitle" class="fw-bold"></h4>
                <p id="galleryDesc" class="text-muted"></p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .gallery-card:hover .inner-img img {
        transform: scale(1.1);
    }
    .inner-img {
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script>
    function showGallery(title, image, desc) {
        document.getElementById('galleryTitle').innerText = title;
        document.getElementById('galleryDesc').innerText = desc;
        document.getElementById('galleryImg').src = "/storage/" + image;

        var galModal = new bootstrap.Modal(document.getElementById('galleryModal'));
        galModal.show();
    }
</script>
@endpush