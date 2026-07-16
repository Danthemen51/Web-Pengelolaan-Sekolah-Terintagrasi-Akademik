<style>
    .footer-custom {
        /* Gradasi dari Biru Muda ke Kuning (Kuning tipis di paling bawah) */
        background: linear-gradient(to bottom, 
            #87cefa 0%, 
            #87cefa 85%, 
            #ffc107 100%); 
        color: #ffffff;
        border: none;
    }

    .footer-second {
        background: linear-gradient(to bottom, 
            #ffc107 0%, 
            #dc3545 15%, 
            #dc3545 100%);
        color: #ffffff;
        border: none;
        margin-top: -1px;
    }

    .footer-custom a {
        color: #ffffff !important;
        text-decoration: none;
        transition: 0.3s;
    }
    
    .footer-custom a:hover {
        opacity: 0.8;
    }
</style>

    <footer class="navbar-navy text-white pt-5 pb-4 footer-custom">
        <div class="container">
            <div class="row">

                <!-- Kolom 1: Alamat & Hubungi -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold border-bottom pb-2">Hubungi Kami</h5>
                    <p>Jl. Ngamprah No.1A, Ngamprah, Kec. Ngamprah, Kabupaten Bandung Barat, Jawa Barat 40552</p>
                    <p><strong>Alamat</strong><br>
                        Jl. Ngamprah No.1A, Ngamprah<br>
                        Kec. Ngamprah, Kabupaten Bandung Barat 40552</p>
                </div>

                <!-- Kolom 2: Program Keahlian -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold border-bottom pb-2">Program Keahlian</h5>
                    <p><a href="#jurusan-section">Teknik Komputer & Jaringan</a></p>
                    <p><a href="#jurusan-section">Pemasaran</a></p>
                    <p><a href="#jurusan-section">Teknik Sepeda Motor</a></p>
                </div>

                {{-- Kolom 3: Kontak Detail --}}
                <div class="col-md-4 mb-4" id="footer-kontak">
                    <h5 class="fw-bold border-bottom pb-2">Kontak</h5>
                    <p><strong>Telepon</strong><br>(022) 86814566</p>
                    <p><strong>Email</strong><br>smkbib.ig@gmail.com</p>
                    <p><strong>Instagram</strong><br>@smk.bib</p>
                </div>
            </div>
        </div>
    </footer>

    {{-- copyright --}}
    <div class="text-center p-1 navbar-navy text-white copyright footer-second">
        <i>SMK Bina Insan Bangsa Ngamprah 2026</i>
    </div>