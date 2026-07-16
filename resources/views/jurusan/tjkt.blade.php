@extends('layouts.app')

@section('content')
    <div class="col-md-10 mb-3 text-center mx-auto mt-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center fw-bold">Teknik Komputer Jaringan dan Telekomunikasi</h4>
                <p class="card-text visimisi-card-text mx-5">
                    Program keahlian Teknik Komputer, Jaringan, dan Telekomunikasi (TJKT) adalah bidang pendidikan yang mempelajari cara merancang, membangun, mengelola, dan mengamankan sistem komputer, jaringan, serta komunikasi data. Jurusan ini mencakup berbagai aspek teknologi informasi dan komunikasi, termasuk perangkat keras komputer, perangkat lunak, jaringan komputer, keamanan siber, serta teknologi telekomunikasi. Lulusan TJKT memiliki keterampilan dalam merancang dan mengelola infrastruktur TI, mengembangkan aplikasi perangkat lunak, serta memahami konsep keamanan dalam dunia digital. Program ini mempersiapkan siswa untuk menghadapi tantangan di era digital dengan pengetahuan yang kuat dalam teknologi komputer dan jaringan.<br><br>
                    <b>Bidang yang Dipelajari:</b>
                    <br>
                    1. Komputer & Sistem Operasi <br>
                    2. Jaringan Komputer <br>
                    3. Telekomunikasi <br>
                    4. Keamanan Jaringan <br>
                    <br>
                    <b>Tujuan Program TJKT</b>
                    <br>
                    Program ini dirancang agar lulusannya:
                    <br>
                    1. Siap kerja sebagai teknisi IT/jaringan
                    <br>
                    2. Bisa membangun dan mengelola jaringan komputer
                    <br>
                    3. Memahami sistem komunikasi modern
                    <br>
                    4. Memiliki dasar keamanan informasi (relevan dengan standar seperti ISO/IEC 27001:2022)<br><br>

                    <b>Peluang Karir:</b><br>
                    1. Network Engineer<br>
                    2. IT Support <br>
                    3. Administrator Server <br>
                    4. Teknisi Telekomunikasi <br>
                    5. Lanjut kuliah : Teknik Informatika, Sistem Informasi, Teknik Elektro, dll.
                    <br><br>

                    <b>Fasilitas:</b><br>
                    1. Laboratorium Komputer dengan perangkat keras dan perangkat lunak terkini<br>
                    2. Laboratorium Jaringan untuk praktik konfigurasi dan manajemen jaringan<br>
                    3. Peralatan Telekomunikasi untuk pembelajaran teknologi komunikasi modern<br>
                </p>

                @if($photos->count())
                    <hr>
                    <h5 class="fw-bold mt-4">Galeri Kegiatan TJKT</h5>
                    <div class="row g-2 mt-2">
                        @foreach($photos as $photo)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $photo->foto) }}"
                                        alt="{{ $photo->caption ?? 'Foto Kegiatan TJKT' }}"
                                        class="img-thumbnail w-100"
                                        style="height:150px;object-fit:cover;cursor:pointer;"
                                        onclick="showPhoto(this.src, '{{ $photo->caption ?? 'Foto Kegiatan TJKT' }}')">
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