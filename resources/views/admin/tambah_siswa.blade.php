<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Siswa</title>
</head>

<body>
    @include('partial.navbar_admin')

    <div class="main-content p-4">
        <div class="container-fluid">
            <h2 class="mb-1">Kelola Siswa</h2>
            <p class="text-muted small mb-4">
                Hubungkan akun siswa (<code>users</code>, role=siswa) ke kelas (<code>siswas</code>).
                Buat akun baru dulu di menu <a href="{{ route('admin.users.create') }}">Tambah User</a> jika belum ada.
            </p>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Tambah Siswa ke Kelas</h5>
                        </div>
                        <div class="card-body p-4">
                            @if ($users->isEmpty())
                                <div class="alert alert-warning mb-0">
                                    Tidak ada akun siswa yang belum punya kelas.
                                    <a href="{{ route('admin.users.create') }}" class="alert-link">Buat user siswa</a>
                                    terlebih dahulu.
                                </div>
                            @else
                                <form method="POST" action="{{ route('siswa.store') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label">Akun Siswa</label>
                                        <select name="user_id" class="form-select" required>
                                            <option value="">-- Pilih siswa --</option>
                                            @foreach ($users as $u)
                                                <option value="{{ $u->id }}" @selected(old('user_id') == $u->id)>
                                                    {{ $u->name }} ({{ $u->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">NISN (Nomor Induk Siswa Nasional)</label>
                                        <input type="text" name="nisn" class="form-control"
                                            value="{{ old('nisn') }}" placeholder="10 digit">
                                        <div class="form-text">Opsional. Harus unik jika diisi.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Kelas</label>
                                        <select name="kelas_id" class="form-select" required
                                            {{ $kelas->isEmpty() ? 'disabled' : '' }}>
                                            <option value="">-- Pilih kelas --</option>
                                            @foreach ($kelas as $k)
                                                <option value="{{ $k->id }}" @selected(old('kelas_id') == $k->id)>
                                                    {{ $k->label ?? $k->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($kelas->isEmpty())
                                            <div class="form-text text-warning">
                                                Belum ada kelas.
                                                <a href="{{ route('kelas.index') }}">Tambah kelas</a> dulu.
                                            </div>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100"
                                        {{ $kelas->isEmpty() ? 'disabled' : '' }}>
                                        Simpan
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card shadow-sm border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Daftar Siswa per Kelas</h5>
                            <span class="badge bg-secondary">{{ $totalSiswa }} total</span>
                        </div>
                        <div class="card-body">
                            @if ($kelas->isEmpty())
                                <p class="text-muted mb-0">Belum ada kelas.</p>
                            @else
                                <div class="accordion" id="accordionSiswaAdmin">
                                    @foreach ($kelas as $k)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#siswa-admin-{{ $k->id }}">
                                                    {{ $k->label }}
                                                    <span class="badge bg-primary ms-2">{{ $k->siswas_count }}
                                                        siswa</span>
                                                </button>
                                            </h2>
                                            <div id="siswa-admin-{{ $k->id }}"
                                                class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                                data-bs-parent="#accordionSiswaAdmin">
                                                <div class="accordion-body p-0">
                                                    @if ($k->siswas->isEmpty())
                                                        <p class="text-muted p-3 mb-0 small">Belum ada siswa di kelas
                                                            ini.</p>
                                                    @else
                                                        <table class="table table-sm table-hover mb-0">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th class="ps-3">Nama</th>
                                                                    <th>Email</th>
                                                                    <th>NISN</th>
                                                                    <th width="130">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($k->siswas as $s)
                                                                    <tr>
                                                                        <td class="ps-3">
                                                                            {{ $s->user?->name ?? '-' }}</td>
                                                                        <td class="small">
                                                                            {{ $s->user?->email ?? '-' }}</td>
                                                                        <td>{{ $s->nisn ?? '-' }}</td>
                                                                        <td class="text-nowrap">
                                                                            <a href="{{ route('siswa.edit', $s) }}"
                                                                                class="btn btn-sm btn-outline-primary">Edit</a>
                                                                            <form
                                                                                action="{{ route('siswa.destroy', $s) }}"
                                                                                method="POST" class="d-inline"
                                                                                onsubmit="return confirm('Hapus siswa dari kelas?');">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-sm btn-outline-danger">Hapus</button>
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>