<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kelas</title>
</head>

<body>
    @include('partial.navbar_admin')

    <div class="main-content p-4">
        <div class="container-fluid">
            <h2 class="mb-3">Kelola Kelas</h2>
            <p class="text-muted small">
                Setiap kelas = <strong>jurusan</strong> + <strong>tingkat</strong> (10/11/12) + <strong>rombel</strong>.
                Contoh: TJKT tingkat 10 rombel 1 → <em>X TJKT 1</em>.
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

            <div class="card mb-4">
                <div class="card-header">Tambah kelas</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('kelas.store') }}" class="row g-3">
                        @csrf
                        <div class="col-md-4">
                            <label class="form-label">Jurusan</label>
                            <select name="jurusan_id" class="form-select" required>
                                <option value="">- Pilih -</option>
                                @foreach ($jurusan as $j)
                                    <option value="{{ $j->id }}">{{ strtoupper($j->kode) }} - {{ $j->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tingkat</label>
                            <select name="tingkat" class="form-select" required>
                                <option value="">- Pilih -</option>
                                <option value="10">X (Kelas 10)</option>
                                <option value="11">XI (Kelas 11)</option>
                                <option value="12">XII (Kelas 12)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Rombel</label>
                            <input type="text" name="rombel" class="form-control" placeholder="1, 2, A..." required>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>

            @if (isset($editKelas))
            <div class="card mb-4 border-warning">
                <div class="card-header bg-warning text-dark">Edit Kelas</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('kelas.update', $editKelas->id) }}" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-4">
                            <label class="form-label">Jurusan</label>
                            <select name="jurusan_id" class="form-select" required>
                                <option value="">- Pilih -</option>
                                @foreach ($jurusan as $j)
                                    <option value="{{ $j->id }}" {{ $editKelas->jurusan_id == $j->id ? 'selected' : '' }}>{{ strtoupper($j->kode) }} - {{ $j->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tingkat</label>
                            <select name="tingkat" class="form-select" required>
                                <option value="">- Pilih -</option>
                                <option value="10" {{ $editKelas->tingkat == 10 ? 'selected' : '' }}>X (Kelas 10)</option>
                                <option value="11" {{ $editKelas->tingkat == 11 ? 'selected' : '' }}>XI (Kelas 11)</option>
                                <option value="12" {{ $editKelas->tingkat == 12 ? 'selected' : '' }}>XII (Kelas 12)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Rombel</label>
                            <input type="text" name="rombel" class="form-control" value="{{ $editKelas->rombel }}" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-success w-100">Update</button>
                            <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
            @endif

            <div class="alert alert-light border d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <span>
                    <strong>Total siswa terdaftar di kelas:</strong> {{ $totalSiswa }}
                    <!-- <span class="text-muted small">(sama dengan angka di Dashboard Admin)</span> -->
                </span>
                <a href="{{ route('siswa.create') }}" class="btn btn-sm btn-outline-primary">Kelola / tambah siswa</a>
            </div>

            <div class="card mb-4">
                <div class="card-header">Daftar kelas</div>
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama kelas</th>
                                <!-- <th>Jurusan</th>
                                <th>Tingkat</th>
                                <th>Rombel</th> -->
                                <th class="text-center">Jumlah Siswa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kelas as $k)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $k->label }}</strong></td>
                                    <!-- <td>{{ strtoupper($k->jurusan?->kode ?? '-') }}</td>
                                    <td>
                                        @if ($k->tingkat)
                                            {{ \App\Models\Kelas::tingkatRomawi((int) $k->tingkat) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $k->rombel ?? '-' }}</td> -->
                                    <td class="text-center">
                                        <span class="badge bg-primary rounded-pill">{{ $k->siswas_count }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('kelas.edit', $k->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                                        <form method="POST" action="{{ route('kelas.destroy', $k->id) }}" class="d-inline" onsubmit="return confirm('Yakin hapus kelas ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-muted">Belum ada kelas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <!-- @if ($kelas->isNotEmpty())
                            <tfoot class="table-light me-5">
                                <tr>
                                    <th colspan="5" class="text-end">Total semua kelas</th>
                                    <th class="text-center">
                                        <span class="badge bg-dark rounded-pill">{{ $totalSiswa }}</span>
                                    </th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        @endif -->
                    </table>
                </div>
            </div>

            <!-- <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Daftar siswa per kelas</span>
                    <span class="badge bg-secondary">{{ $totalSiswa }} siswa</span>
                </div>
                <div class="card-body">
                    @if ($kelas->isEmpty())
                        <p class="text-muted mb-0">Belum ada kelas. Tambahkan kelas terlebih dahulu.</p>
                    @else
                        <div class="accordion" id="accordionSiswaKelas">
                            @foreach ($kelas as $k)
                                <div class="accordion-item" id="siswa-kelas-{{ $k->id }}">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse-kelas-{{ $k->id }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                            <strong>{{ $k->label }}</strong>
                                            <span class="badge bg-primary ms-2">{{ $k->siswas_count }} siswa</span>
                                        </button>
                                    </h2>
                                    <div id="collapse-kelas-{{ $k->id }}"
                                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        data-bs-parent="#accordionSiswaKelas">
                                        <div class="accordion-body p-0">
                                            @if ($k->siswas->isEmpty())
                                                <p class="text-muted p-3 mb-0">Belum ada siswa di kelas ini.</p>
                                            @else
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-hover mb-0">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th class="ps-3">#</th>
                                                                <th>Nama</th>
                                                                <th>Email</th>
                                                                <th>NISN</th>
                                                                <th width="140">Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($k->siswas as $s)
                                                                <tr>
                                                                    <td class="ps-3">{{ $loop->iteration }}</td>
                                                                    <td>{{ $s->user?->name ?? '-' }}</td>
                                                                    <td class="small">{{ $s->user?->email ?? '-' }}</td>
                                                                    <td>{{ $s->nisn ?? '-' }}</td>
                                                                    <td class="text-nowrap">
                                                                        <a href="{{ route('siswa.edit', $s) }}"
                                                                            class="btn btn-sm btn-outline-primary">Edit</a>
                                                                        <form action="{{ route('siswa.destroy', $s) }}"
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
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div> -->
        </div>
    </div>
</body>

</html>
