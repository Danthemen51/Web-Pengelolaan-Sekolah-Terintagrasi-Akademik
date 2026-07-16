@extends('layouts.app')
<style>
    .news-scroll-wrapper .card {
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .news-scroll-wrapper .card-body {
        min-height: 120px; 
        padding: 1rem;
        white-space: normal; 
    }

    .news-scroll-wrapper .card-title {
        height: 2.8em;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        white-space: normal;
    }

    .news-scroll-wrapper .card-text {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
    
</style>

@section('content')
    <div id="carouselExampleCaptions" class="carousel slide ">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/smkbib.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Kegiatan Magang Industri</h5>
                    <p>Pengalaman langsung di dunia kerja bersama mitra industri.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/pramuka.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Kegiatan Pramuka</h5>
                    <p>Membangun jiwa kepemimpinan dan kemandirian.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/volley.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Prestasi Olahraga</h5>
                    <p>Semangat sportivitas dan kerja sama tim.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="navbottom mb-4 mt-3">
        <a href="#tentang-kami-section">Profil</a>
        <a href="#visi-misi-section">Visi & Misi</a>
        <a href="#news-section">Berita</a>
    </div>

    <hr class="mb-4" style="width: 30%; border: 1px solid black; margin: auto;">

    <div id="tentang-kami-section" class="yt text-center scroll-target">
        <h2 class="fw-bold">TENTANG KAMI</h2>
        <iframe width="900" height="500" src="https://www.youtube.com/embed/6e57QsLmK1g?si=wmK4eoPzQpgxBlZa"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>

    <div id="visi-misi-section" class="container mt-4 pt-2 mb-5 scroll-target">
        <h1 class="text-center fw-bold">SMK BINA INSAN BANGSA NGAMPRAH</h1>
        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title fw-bold text-center">Tujuan</h3>
                        <p class="card-text">Menghasilkan lulusan yang tidak hanya unggul secara intelektual dan
                            profesional di bidang teknologi, tetapi juga memiliki karakter kuat berlandaskan iman,
                            taqwa, dan budaya. Melalui sinergi dengan dunia industri dan pengembangan jiwa
                            kewirausahaan, sekolah berkomitmen membekali siswa dengan keterampilan praktis yang relevan
                            agar siap bersaing secara global di era Revolusi Industri 4.0.</p>
                        <a href="{{ route('visimisi') }}" class="btn btn-warning">Lihat Tujuan</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title fw-bold text-center">Visi & Misi</h3>
                        <p class="card-text"><strong>Visi:</strong> Menjadi sekolah vokasi unggul yang mencetak generasi
                            profesional, inovatif, berakhlak mulia, dan berdaya saing global.<br>
                            <strong>Misi:</strong> Meningkatkan kompetensi siswa melalui pembelajaran berbasis industri,
                            memperkuat kerja sama dengan DU/DI, menyediakan fasilitas pendidikan berbasis IPTEK dan
                            IMTAQ, serta menumbuhkan jiwa kewirausahaan untuk menghadapi era Revolusi Industri 4.0.
                        </p>
                        <a href="{{ route('visimisi') }}" class="btn btn-warning">Lihat Visi & Misi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="news-section py-2" id="news-section">
        <div class="container">
            <h2 class="text-center mb-4 fw-bold">Berita Terkini</h2>

            <div class="news-scroll-wrapper">
                <div class="row flex-nowrap pb-4" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                    @forelse($news as $item)
                        <div class="col-10 col-md-4">
                            <div class="card h-100 shadow-sm border-0">
                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top"
                                        alt="{{ $item->title }}"
                                        style="height: 180px; object-fit: cover; border-radius: 8px 8px 0 0;">
                                @else
                                    <img src="{{ asset('images/bibdalam3.jpg') }}" class="card-img-top"
                                        alt="Default Image" style="height: 180px; object-fit: cover;">
                                @endif

                                <div class="card-body">
                                    <h6 class="card-title fw-bold">{{ Str::limit($item->title, 50) }}</h6>
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-calendar"></i> {{ $item->created_at->format('d M Y') }}
                                    </p>
                                    <p class="card-text small text-secondary">{{ $item->excerpt }}</p>
                                </div>

                                <div class="card-footer bg-white border-top-0 p-3">
                                    <button type="button" class="btn btn-outline-primary btn-sm w-100"
                                        onclick="showNews('{{ addslashes($item->title) }}', '{{ $item->image }}', '{{ addslashes($item->content) }}', '{{ addslashes($item->author) }}')">
                                        Baca Selengkapnya
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted">
                            <p>Belum ada berita yang diterbitkan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="newsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" class="img-fluid mb-3"
                        style="width: 100%; height: auto; display: none; border-radius: 8px;">
                        <h5 class="modal-title fw-bold" id="modalTitle"></h5>
                    <p class="text-muted"><small id="modalAuthor"></small></p>
                    <div id="modalContent" style="line-height: 1.6; text-align: justify;"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="gallery-section" class="container my-5 scroll-target" style="display: none;"></div>
    <div id="ppdb-section" class="container my-5 scroll-target" style="display: none;"></div>
    <div id="kontak-section" class="scroll-target" style="position: relative; top: -60px; visibility: hidden;"></div>
@endsection
<script>
    function showNews(title, image, content, author) {
        document.getElementById('modalTitle').innerText = title;

        document.getElementById('modalAuthor').innerText = "Penulis: " + author;

        const modalImg = document.getElementById('modalImage');
        if (image) {
            modalImg.src = "/storage/" + image;
            modalImg.style.display = "block";
        } else {
            modalImg.style.display = "none";
        }

        document.getElementById('modalContent').innerHTML = content;

        var myModal = new bootstrap.Modal(document.getElementById('newsModal'));
        myModal.show();
    }
</script>
