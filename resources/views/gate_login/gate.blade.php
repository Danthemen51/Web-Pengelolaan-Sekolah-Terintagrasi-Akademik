<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row justify-content-center w-100">
            
            <div class="col-md-6 mb-4 col-sm-6">
                <a href="" class="nav-link">
                    <div class="card hover-zoom shadow-sm">
                        <div class="card-body text-center">
                            <img src="{{asset('images/gate/siswa.png')}}" alt="Login Siswa" class="card-img-top mb-3" style="width: 150px;">
                            <h5 class="card-title fw-bold">Login Siswa</h5>
                            <p class="text-muted">Klik untuk login sebagai siswa</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6 mb-4 col-sm-6">
                <a href="" class="nav-link">
                    <div class="card hover-zoom shadow-sm">
                        <div class="card-body text-center">
                            <img src="{{asset('images/gate/guru.png')}}" alt="Login Guru" class="card-img-top mb-3" style="width: 150px;">
                            <h5 class="card-title fw-bold">Login Guru</h5>
                            <p class="text-muted">Klik untuk login sebagai guru</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>