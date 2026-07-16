<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
        }

        .btn-custom {
            display: block;
            width: 100%;
            padding: 10px 15px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 5px;
        }

        /* Sidebar Desktop */
        @media (min-width: 992px) {
            .sidebar {
                width: 250px;
                height: 100vh;
                position: fixed;
                left: 0;
                top: 0;
                z-index: 1000;
            }

            .main-content {
                margin-left: 250px;
            }
        }

        /* Sidebar Mobile */
        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
                position: relative;
            }

            .sidebar.collapse:not(.show) {
                display: none;
            }
        }
    </style>
</head>

<body>

    @include('partial.navbar_admin')

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="card shadow border-0" style="border-radius: 15px;">
                    <div class="card-header bg-primary text-white" style="border-radius: 15px 15px 0 0;">
                        <h5 class="mb-0">Tambah User</h5>
                    </div>
                    <div class="card-body p-4">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.users.store') }}" method="POST">
                            @csrf

                            <label>Nama</label>
                            <input type="text" name="name" required style="width: 100%; margin-bottom: 10px;"><br>

                            <label>Email</label>
                            <input type="email" name="email" required style="width: 100%; margin-bottom: 10px;"><br>

                            <label>Password</label>
                            <input type="password" name="password" required
                                style="width: 100%; margin-bottom: 10px;"><br>
                            <label>Konfirmasi Password</label>
                            <input type="password" style="width: 100%; margin-bottom: 10px;"
                                name="password_confirmation" required>

                            <label>Role</label>
                            <select name="role" required style="width: 100%; margin-bottom: 10px;">
                                <option value="">-- Pilih Role --</option>
                                <option value="admin">Admin</option>
                                <option value="guru">Guru</option>
                                <option value="siswa">Siswa</option>
                            </select><br><br>
                            <div class="button-user mx-auto d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Tambah User</button>
                                <a href="/admin" class="btn btn-danger">Dashboard</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</body>

</html>
