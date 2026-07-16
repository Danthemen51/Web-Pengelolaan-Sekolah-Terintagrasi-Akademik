@extends('layouts.app')

@section('content')
    <div class="col-md-10 mb-3 text-center mx-auto mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center fw-bold">Bisnis Daring & Pemasaran</h4>
                <p class="card-text visimisi-card-text mx-5">
                    Program keahlian Bisnis Daring &amp; Pemasaran adalah bidang pendidikan yang mempelajari cara merancang, membangun, dan mengelola bisnis di dunia digital. Jurusan ini mencakup berbagai aspek teknologi informasi dan komunikasi, termasuk e-commerce, digital marketing, social media marketing, dan manajemen data pelanggan. Lulusan BDP memiliki keterampilan dalam merancang dan mengelola strategi pemasaran digital, mengembangkan aplikasi perangkat lunak untuk bisnis, serta memahami konsep keamanan dalam dunia digital. Program ini mempersiapkan siswa untuk menghadapi tantangan di era digital dengan pengetahuan yang kuat dalam teknologi informasi dan pemasaran.<br><br>
                    <b>Bidang yang Dipelajari:</b>
                    <br>
                    1. Dasar-dasar Pemasaran <br>
                    2. Komunikasi &amp; Pelayanan Konsumen <br>
                    3. Pemasaran Digital (Digital Marketing) <br>
                    4. Administrasi Penjualan <br>
                    <br>
                    <b>Tujuan Program BDP</b>
                    <br>
                    Program ini dirancang agar lulusannya:
                    <br>
                    1. Bisa menjual produk secara efektif
                    <br>
                    2. Memahami strategi bisnis dan pemasaran
                    <br>
                    3. Siap kerja di dunia retail atau bisnis online
                    <br>
                    4. Bisa membuka usaha sendiri<br><br>

                    <b>Peluang Karir:</b><br>
                    1. Sales / Pramuniaga<br>
                    2. Digital Marketer <br>
                    3. Admin Online Shop <br>
                    4. Content Creator <br>
                    5. Wirausahawan <br>
                    6. Lanjut kuliah : Bisnis Digital, Marketing, Akuntansi, dll.
                    <br><br>

                    <b>Fasilitas:</b><br>
                    1. Laboratorium Komputer dengan perangkat keras dan perangkat lunak untuk bisnis digital<br>
                    2. Peralatan untuk praktik pemasaran dan penjualan<br>
                    3. Fasilitas untuk pembelajaran strategi bisnis dan pemasaran<br>
                </p>

                @if($photos->count())
                    <hr>
                    <h5 class="fw-bold mt-4">Galeri Kegiatan BDP</h5>
                    <div class="row g-2 mt-2">
                        @foreach($photos as $photo)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $photo->foto) }}"
                                        alt="{{ $photo->caption ?? 'Foto Kegiatan BDP' }}"
                                        class="img-thumbnail w-100"
                                        style="height:150px;object-fit:cover;cursor:pointer;"
                                        onclick="showPhoto(this.src, '{{ $photo->caption ?? 'Foto Kegiatan BDP' }}')">
                                    @if($photo->caption)
                                        <small class="d-block text-muted mt-1 text-start">{{ $photo->caption }}</small>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Modal Preview Foto --}}
    <div class="modal fade" id="photoModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="photoModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0 text-center">
                    <img id="photoModalImage" src="" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function showPhoto(src, caption) {
            document.getElementById('photoModalImage').src = src;
            document.getElementById('photoModalTitle').innerText = caption;
            new bootstrap.Modal(document.getElementById('photoModal')).show();
        }
    </script>
    @endpush
@endsection