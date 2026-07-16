@extends('layouts.app')

@section('content')
    <div class="col-md-10 mb-3 text-center mx-auto mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center fw-bold">Teknik dan Bisnis Sepeda Motor</h4>
                <p class="card-text visimisi-card-text mx-5">
                    Program keahlian Teknik dan Bisnis Sepeda Motor adalah bidang pendidikan yang mempelajari perawatan, perbaikan, serta manajemen bisnis kendaraan roda dua (sepeda motor). Siswa equipados dengan keterampilan teknis dan manajerial, mulai dari servis ringan hingga perbaikan total serta memahami sistem kelistrikan dan injeksi modern.<br><br>
                    <b>Bidang yang Dipelajari:</b>
                    <br>
                    1. Perawatan dan Perbaikan Sepeda Motor <br>
                    2. Sistem Kelistrikan dan Injeksi Modern <br>
                    3. Teknologi Sepeda Motor Modern <br>
                    4. Bisnis &amp; Kewirausahaan Bengkel <br>
                    <br>
                    <b>Tujuan Program TBSM</b>
                    <br>
                    Program ini dirancang agar lulusannya:
                    <br>
                    1. Mahir memperbaiki dan merawat sepeda motor
                    <br>
                    2. Paham teknologi otomotif terbaru
                    <br>
                    3. Siap kerja di bengkel resmi atau umum
                    <br>
                    4. Bisa membuka usaha bengkel sendiri<br><br>

                    <b>Peluang Karir:</b><br>
                    1. Teknisi Sepeda Motor<br>
                    2. Mekanik Bengkel <br>
                    3. Admin Bengkel <br>
                    4. Wirausahawan <br>
                    5. Lanjut kuliah : Teknik Mesin, Teknik Otomotif, dll.
                    <br><br>

                    <b>Fasilitas:</b><br>
                    1. Bengkel praktik dengan peralatan lengkap untuk perawatan dan perbaikan sepeda motor<br>
                    2. Peralatan untuk pembelajaran sistem kelistrikan dan injeksi modern<br>
                    3. Fasilitas untuk pembelajaran manajemen bisnis bengkel<br>
                </p>

                @if($photos->count())
                    <hr>
                    <h5 class="fw-bold mt-4">Galeri Kegiatan TBSM</h5>
                    <div class="row g-2 mt-2">
                        @foreach($photos as $photo)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $photo->foto) }}"
                                        alt="{{ $photo->caption ?? 'Foto Kegiatan TBSM' }}"
                                        class="img-thumbnail w-100"
                                        style="height:150px;object-fit:cover;cursor:pointer;"
                                        onclick="showPhoto(this.src, '{{ $photo->caption ?? 'Foto Kegiatan TBSM' }}')">
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