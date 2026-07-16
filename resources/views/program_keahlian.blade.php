@extends('layouts.app')
@section('content')
    <div class="main">
        <div class="banner-berita">
            <h1 class="fw-bold">Program Keahlian</h1>
        </div>
        <div class="banner d-flex align-items-center justify-content-center" style="background-color: #87cefa">
            <h1 class="fw-bold text-white">Kembangkan bakat dan minatmu di SMK Bina Insan Bangsa</h1>
        </div>
        <div class="container py-4">
            <div class="row justify-content-center">
                {{-- TJKT --}}
                <div class="col-11 col-lg-10">
                    <div class="card mb-4 shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('images/tjkt.jpg') }}" class="img-fluid rounded-start" alt="TJKT">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Teknik Komputer, Jaringan, dan Telekomunikasi</h5>
                                    <p class="card-text text-secondary">Program keahlian <b>Teknik Komputer, Jaringan, dan Telekomunikasi (TJKT)</b> adalah bidang pendidikan yang mempelajari cara merancang, membangun, mengelola, dan mengamankan sistem komputer, jaringan, serta komunikasi data.</p>
                                    @if($photos['tjkt']->count())
                                        <div class="mb-2">
                                            @foreach($photos['tjkt']->take(3) as $photo)
                                                <img src="{{ asset('storage/' . $photo->foto) }}"
                                                    alt="{{ $photo->caption ?? 'Foto Kegiatan TJKT' }}"
                                                    class="rounded me-1 mb-1"
                                                    style="width:80px;height:60px;object-fit:cover;"
                                                    data-bs-toggle="tooltip" title="{{ $photo->caption ?? 'Foto Kegiatan' }}">
                                            @endforeach
                                            @if($photos['tjkt']->count() > 3)
                                                <small class="text-muted">+{{ $photos['tjkt']->count() - 3 }} foto lainnya</small>
                                            @endif
                                        </div>
                                    @endif
                                    <a href="{{ route('jurusan.show', ['jurusan' => 'tjkt']) }}" class="btn btn-danger">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BDP --}}
                <div class="col-11 col-lg-10">
                    <div class="card mb-4 shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('images/pms.jpg') }}" class="img-fluid rounded-start" alt="BDP">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Bisnis Daring dan Pemasaran</h5>
                                    <p class="card-text text-secondary">Program keahlian <b>Bisnis Daring dan Pemasaran (BDP)</b> adalah bidang pendidikan yang mempelajari cara menawarkan, mempromosikan, dan menjual produk atau jasa kepada konsumen, baik secara langsung maupun melalui media digital.</p>
                                    @if($photos['bdp']->count())
                                        <div class="mb-2">
                                            @foreach($photos['bdp']->take(3) as $photo)
                                                <img src="{{ asset('storage/' . $photo->foto) }}"
                                                    alt="{{ $photo->caption ?? 'Foto Kegiatan BDP' }}"
                                                    class="rounded me-1 mb-1"
                                                    style="width:80px;height:60px;object-fit:cover;"
                                                    data-bs-toggle="tooltip" title="{{ $photo->caption ?? 'Foto Kegiatan' }}">
                                            @endforeach
                                            @if($photos['bdp']->count() > 3)
                                                <small class="text-muted">+{{ $photos['bdp']->count() - 3 }} foto lainnya</small>
                                            @endif
                                        </div>
                                    @endif
                                    <a href="{{ route('jurusan.show', ['jurusan' => 'bdp']) }}" class="btn btn-danger">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TBSM --}}
                <div class="col-11 col-lg-10">
                    <div class="card mb-4 shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('images/tbsm.jpg') }}" class="img-fluid rounded-start" alt="TBSM">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Teknik dan Bisnis Sepeda Motor</h5>
                                    <p class="card-text text-secondary">Program keahlian <b>Teknik dan Bisnis Sepeda Motor (TBSM)</b> adalah jurusan yang mempelajari perawatan, perbaikan, serta manajemen bisnis kendaraan roda dua (sepeda motor).</p>
                                    @if($photos['tbsm']->count())
                                        <div class="mb-2">
                                            @foreach($photos['tbsm']->take(3) as $photo)
                                                <img src="{{ asset('storage/' . $photo->foto) }}"
                                                    alt="{{ $photo->caption ?? 'Foto Kegiatan TBSM' }}"
                                                    class="rounded me-1 mb-1"
                                                    style="width:80px;height:60px;object-fit:cover;"
                                                    data-bs-toggle="tooltip" title="{{ $photo->caption ?? 'Foto Kegiatan' }}">
                                            @endforeach
                                            @if($photos['tbsm']->count() > 3)
                                                <small class="text-muted">+{{ $photos['tbsm']->count() - 3 }} foto lainnya</small>
                                            @endif
                                        </div>
                                    @endif
                                    <a href="{{ route('jurusan.show', ['jurusan' => 'tbsm']) }}" class="btn btn-danger">Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection