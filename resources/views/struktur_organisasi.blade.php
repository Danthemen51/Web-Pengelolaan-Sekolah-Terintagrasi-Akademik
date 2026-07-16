@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold display-6">Struktur Organisasi</h1>
        <p class="text-muted mb-0">Susunan organisasi dan jabatan di SMK Bina Insan Bangsa</p>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-lg-10">
            @if (file_exists(public_path('storage/struktur_organisasi.png')))
                <div class="rounded-4 shadow-sm overflow-hidden mb-4">
                    <img src="{{ asset('storage/struktur_organisasi.png') }}" alt="Struktur Organisasi"
                        class="img-fluid w-100" style="display:block;">
                </div>
            @endif

            {{-- <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="py-3" style="width: 40%;">Jabatan</th>
                                    <th class="py-3">Penanggung Jawab</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Kepala Sekolah</strong></td>
                                    <td>Drs. H. Ahmad Fauzi, M.Pd.</td>
                                </tr>
                                <tr>
                                    <td><strong>Wakil Kepala Sekolah Bidang Kurikulum</strong></td>
                                    <td>Dra. Siti Nurhaliza</td>
                                </tr>
                                <tr>
                                    <td><strong>Wakil Kepala Sekolah Bidang Kesiswaan</strong></td>
                                    <td>Budi Santoso, S.Pd.</td>
                                </tr>
                                <tr>
                                    <td><strong>Wakil Kepala Sekolah Bidang Sarana & Prasarana</strong></td>
                                    <td>Rina Wulandari, S.Pd.</td>
                                </tr>
                                <tr>
                                    <td><strong>Kepala Tata Usaha</strong></td>
                                    <td>Dedi Kurniawan, S.Kom.</td>
                                </tr>
                                <tr>
                                    <td><strong>Koordinator Kompetensi Keahlian Teknik Komputer dan Jaringan</strong></td>
                                    <td>Agus Setiawan, M.Kom.</td>
                                </tr>
                                <tr>
                                    <td><strong>Koordinator Kompetensi Keahlian Rekayasa Perangkat Lunak</strong></td>
                                    <td>Dewi Lestari, S.Kom., M.Kom.</td>
                                </tr>
                                <tr>
                                    <td><strong>Koordinator Kompetensi Keahlian Akuntansi dan Keuangan Lembaga</strong></td>
                                    <td>Hendra Wijaya, S.E., M.Si.</td>
                                </tr>
                                <tr>
                                    <td><strong>Koordinator Bimbingan Konseling</strong></td>
                                    <td>Fitriani Hasan, S.Pd.</td>
                                </tr>
                                <tr>
                                    <td><strong>Koordinator Hubin (Hubungan Industri)</strong></td>
                                    <td>Rizki Pratama, S.T.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}

            {{-- <div class="mt-4 p-3 bg-light rounded-3">
                <p class="mb-0 text-muted small">
                    <svg class="me-2" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle;">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 8v4M12 16h.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Untuk memperbarui struktur organisasi, silakan edit file <code>resources/views/struktur_organisasi.blade.php</code> atau hubungi administrator.
                </p>
            </div> --}}
        </div>
    </div>
</div>
@endsection
