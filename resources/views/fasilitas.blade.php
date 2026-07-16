@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="banner-berita">
        <h1>FASILITAS KAMI</h1>
    </div>

    <div class="fasilitas-title text-white bg-danger" >
        <h1 class="fw-bold text-center">DAFTAR FASILITAS SMK BINA INSAN BANGSA</h1>
    </div>

    <div class="container">
        <div class="row  justify-content-center" style="text-align: justify;">
            <div class="col-10 col-md-3 mb-3">
                <div class="card" style="width: 18rem;">
                    <div class="ratio ratio-1x1">
                        <img src="{{ asset('images/tefa.jpeg') }}" class="card-img-top object-fit-cover" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold">Teaching Factory</h5>
                        <p class="card-text card-text-truncate ">Fasilitas praktik di sekolah SMK yang dirancang menyerupai tempat kerja nyata. Ruangan ini mengintegrasikan kurikulum pendidikan dengan standar industri untuk menghasilkan produk atau jasa nyata, bertujuan menyelaraskan keterampilan siswa dengan kebutuhan dunia kerja.</p>
                        <hr>
                        <p>Jumlah: 1</p>
                    </div>
                </div>
            </div>
            <div class="col-10 col-md-3 mb-3">
                <div class="card" style="width: 18rem;">
                    <div class="ratio ratio-1x1">
                        <img src="{{ asset('images/lapang.jpeg') }}" class="card-img-top object-fit-cover " alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold">Lapang Serba Bisa</h5>
                        <p class="card-text card-text-truncate">Lapangan yang dapat digunakan untuk berbagai kegiatan seperti olahraga, kegiatan ekstrakurikuler, kegiatan baris berbaris, maupun acara sekolah. Dengan fasilitas yang memadai, lapangan ini menjadi tempat yang ideal untuk berbagai kegiatan positif.</p>
                        <hr>
                        <p>Jumlah: 1</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-10 mb-3">
                <div class="card" style="width: 18rem;">
                    <div class="ratio ratio-1x1">
                        <img src="{{ asset('images/labkom2.jpeg') }}" class="card-img-top object-fit-cover" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold">Lab Komputer</h5>
                        <p class="card-text card-text-truncate">Fasilitas laboratorium komputer yang dilengkapi dengan peralatan modern untuk pembelajaran teknologi informasi dan komunikasi. Tempat ini digunakan untuk praktik dan eksplorasi dalam bidang IT.</p>
                        <hr>
                        <p>Jumlah: 3</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-10 mb-3">
                <div class="card" style="width: 18rem;">
                    <div class="ratio ratio-1x1">
                        <img src="{{ asset('images/bengkel3.jpeg') }}" class="card-img-top object-fit-cover" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold">Bengkel Praktik</h5>
                        <p class="card-text card-text-truncate">Fasilitas bengkel praktik yang dilengkapi dengan peralatan modern untuk pembelajaran teknik kendaraan. Tempat siswa belajar mengenal dan mengoperasikan peralatan seperti mesin, alat ukur, dan lainnya.</p>
                        <hr>
                        <p>Jumlah: 1</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-10 mb-3">
                <div class="card" style="width: 18rem;">
                    <div class="ratio ratio-1x1">
                        <img src="{{ asset('images/mushola.jpeg') }}" class="card-img-top object-fit-cover" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold">Mushola</h5>
                        <p class="card-text card-text-truncate">Fasilitas mushola yang nyaman untuk kegiatan ibadah dan kegiatan sosial. Tempat ini menyediakan fasilitas yang memadai untuk kebutuhan ibadah jamaah.</p>
                        <hr>
                        <p>Jumlah: 1</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-10 mb-3">
                <div class="card" style="width: 18rem;">
                    <div class="ratio ratio-1x1">
                        <img src="{{ asset('images/perpus3.jpeg') }}" class="card-img-top object-fit-cover" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold">Perpustakaan</h5>
                        <p class="card-text card-text-truncate">Fasilitas perpustakaan yang menyediakan berbagai koleksi buku, jurnal, dan sumber belajar lainnya untuk mendukung kegiatan pembelajaran siswa. Perpustakaan juga tempat yang pas untuk dijadikan tempat diskusi bersama dengan teman karena suasananya yang tenang</p>
                        <hr>
                        <p>Jumlah: 1</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-10 mb-3">
                <div class="card" style="width: 18rem;">
                    <div class="ratio ratio-1x1">
                        <img src="{{ asset('images/bibdalam3.jpeg') }}" class="card-img-top object-fit-cover" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-center fw-bold">Gedung 3 Lantai</h5>
                        <p class="card-text card-text-truncate">Fasilitas gedung 3 lantai yang menyediakan ruang kelas, ruang guru, dan fasilitas lainnya untuk mendukung kegiatan pembelajaran. Gedung ini dirancang untuk memberikan lingkungan belajar yang nyaman dan efektif.</p>
                        <hr>
                        <p>Jumlah: 3</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection