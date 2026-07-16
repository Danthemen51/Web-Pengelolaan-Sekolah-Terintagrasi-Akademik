@extends('layouts.app')

@section('content')

<div class="main">
    <div class="banner-berita">
        <h1>Contact Us</h1>
    </div>

    {{-- Kontak --}}
    <div class="container my-5">
        <div class="row text-center mb-3">
            <h1 class="fw-bold">Hubungi Kami Melalui</h1>
        </div>
        <div class="row text-center">
            <div class="col-md-3">
                <div class="card p-4 shados-sm rounded-4">
                    <div class="mb-3">
                        <i class="bi bi-instagram fs-1"></i>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Instagram</p>
                        <p class="card-text">@smk.bib</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4 shados-sm rounded-4">
                    <div class="mb-3">
                        <i class="bi bi-telephone fs-1"></i>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Telepon</p>
                        <p class="card-text">(022) 86814566</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4 shados-sm rounded-4">
                    <div class="mb-3">
                        <i class="bi bi-whatsapp fs-1"></i>
                    </div>
                    <div class="card-body">
                        <p class="card-text">WhatsApp</p>
                        <p class="card-text">08123456789</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-4 shados-sm rounded-4">
                    <div class="mb-3">
                        <i class="bi bi-envelope fs-1"></i>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Email</p>
                        <p class="card-text">smkbib.ig@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Maps --}}
    <div class="container my-5">
        <div class="row text-center mb-3">
            <h1 class="fw-bold">Lokasi Kami</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.5180539090334!2d107.49669887499566!3d-6.828312293169583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e338b19c7f8b%3A0xe5b140b323908936!2sSMK%20Bina%20Insan%20Bangsa!5e0!3m2!1sid!2sid!4v1776045428758!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection