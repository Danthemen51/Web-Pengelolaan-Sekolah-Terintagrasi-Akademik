<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapping Pembelajaran</title>
</head>

<body>
    @include('partial.navbar_admin')

    <div class="main-content p-4">
        <div class="container-fluid">
            <h2 class="mb-1">Mapping Pembelajaran</h2>
            <p class="text-muted mb-4">
                Mapel berbeda per <strong>jurusan</strong> (BDP, TJKT, TBSM) dan per <strong>tingkat</strong> (X, XI, XII).
                Contoh: mapel kelas X TJKT ≠ mapel kelas XI TJKT, meskipun jurusannya sama.
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

            <div class="card mb-4 border-0 bg-light">
                <div class="card-body py-3">
                    <div class="d-flex flex-wrap align-items-center gap-2 small">
                        <span class="badge rounded-pill bg-secondary">1</span> Jurusan
                        <span class="text-muted">→</span>
                        <span class="badge rounded-pill bg-secondary">2</span> Tingkat (10 / 11 / 12)
                        <span class="text-muted">→</span>
                        <span class="badge rounded-pill bg-secondary">3</span> Kelas (rombel)
                        <span class="text-muted">→</span>
                        <span class="badge rounded-pill bg-secondary">4</span> Mapel (sesuai jurusan + tingkat)
                        <span class="text-muted">→</span>
                        <span class="badge rounded-pill bg-secondary">5</span> Guru
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card mb-4">
                        <div class="card-header bg-dark text-white">Langkah 1 & 2 - Jurusan & Tingkat</div>
                        <div class="card-body">
                            <label class="form-label fw-semibold">Jurusan</label>
                            <div class="d-grid gap-2 mb-3">
                                @foreach ($jurusan as $j)
                                    <button type="button"
                                        class="btn btn-outline-primary text-start jurusan-btn"
                                        data-id="{{ $j->id }}"
                                        data-kode="{{ strtoupper($j->kode) }}"
                                        data-nama="{{ $j->nama }}">
                                        <strong>{{ strtoupper($j->kode) }}</strong>
                                        <span class="d-block small text-muted">{{ $j->nama }}</span>
                                    </button>
                                @endforeach
                            </div>

                            <label class="form-label fw-semibold mt-2">Tingkat / Angkatan</label>
                            <div class="btn-group w-100 mb-3" role="group">
                                @foreach ([10 => 'X (Kelas 10)', 11 => 'XI (Kelas 11)', 12 => 'XII (Kelas 12)'] as $t => $label)
                                    <button type="button" class="btn btn-outline-secondary tingkat-btn flex-fill"
                                        data-tingkat="{{ $t }}" disabled>{{ $label }}</button>
                                @endforeach
                            </div>

                            <div class="alert alert-info mb-0 py-2 small" id="konteks-info">
                                Pilih jurusan dan tingkat terlebih dahulu.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-success text-white">
                            Mapel untuk jurusan & tingkat ini
                            <span class="d-block small fw-normal opacity-75">Tabel <code>mapels</code> (jurusan_id + tingkat)</span>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush mb-3 small" id="daftar-mapel">
                                <li class="list-group-item text-muted">Pilih jurusan & tingkat</li>
                            </ul>
                            <form method="POST" action="{{ route('admin.mapel.store') }}" id="form-mapel" class="d-none">
                                @csrf
                                <input type="hidden" name="jurusan_id" id="mapel-jurusan-id">
                                <input type="hidden" name="tingkat" id="mapel-tingkat">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="nama" class="form-control" placeholder="Nama mapel baru" required>
                                    <button type="submit" class="btn btn-success">+ Tambah</button>
                                </div>
                            </form>
                            <p class="small text-muted mb-0">
                                Mapel TJKT kelas X tidak muncul saat Anda memilih tingkat XI - supaya tidak tertukar antar angkatan.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Panel kanan: penugasan --}}
                <div class="col-lg-7">
                    <div class="card mb-4">
                        <div class="card-header">Langkah 3, 4 & 5 - Penugasan guru mengajar</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.mapping.store') }}" id="form-penugasan">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Kelas (rombel)</label>
                                    <select name="kelas_id" id="select-kelas" class="form-select" required disabled>
                                        <option value="">- Pilih jurusan & tingkat dulu -</option>
                                    </select>
                                    <div class="form-text">
                                        Belum ada kelas?
                                        <a href="{{ route('kelas.index') }}">Tambah di Kelola Kelas</a>
                                        (pilih jurusan + tingkat + rombel yang sama).
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Mata pelajaran</label>
                                    <select name="mapel_id" id="select-mapel" class="form-select" required disabled>
                                        <option value="">- Pilih jurusan & tingkat dulu -</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Guru</label>
                                    <select name="guru_id" class="form-select" required {{ $guru->isEmpty() ? 'disabled' : '' }}>
                                        <option value="">- Pilih guru -</option>
                                        @foreach ($guru as $g)
                                            <option value="{{ $g->id }}" @selected(old('guru_id') == $g->id)>{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary" id="btn-simpan" disabled>
                                    Simpan penugasan
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <span>Daftar penugasan</span>
                            <span class="badge bg-secondary">{{ $mappings->count() }}</span>
                        </div>
                        <div class="card-body p-0">
                            @if ($mappings->isEmpty())
                                <p class="p-4 text-muted mb-0 small">Belum ada penugasan.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Guru</th>
                                                <th>Jurusan</th>
                                                <th>Tingkat</th>
                                                <th>Kelas</th>
                                                <th>Mapel</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($mappings as $row)
                                                <tr>
                                                    <td>{{ $row->guru?->name ?? '-' }}</td>
                                                    <td>{{ strtoupper($row->kelas?->jurusan?->kode ?? $row->mapel?->jurusan?->kode ?? '-') }}</td>
                                                    <td>
                                                        @if ($row->kelas?->tingkat)
                                                            {{ \App\Models\Kelas::tingkatRomawi((int) $row->kelas->tingkat) }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ $row->kelas?->label ?? $row->kelas?->nama ?? '-' }}</td>
                                                    <td>{{ $row->mapel?->nama ?? '-' }}</td>
                                                    <td>
                                                        <form method="POST" action="{{ route('admin.mapping.destroy', $row) }}"
                                                            onsubmit="return confirm('Hapus?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger py-0">×</button>
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
            </div>
        </div>
    </div>

    <script>
        let jurusanId = null;
        let jurusanKode = '';
        let tingkat = null;

        const konteksInfo = document.getElementById('konteks-info');
        const selectKelas = document.getElementById('select-kelas');
        const selectMapel = document.getElementById('select-mapel');
        const daftarMapel = document.getElementById('daftar-mapel');
        const formMapel = document.getElementById('form-mapel');
        const formPenugasan = document.getElementById('form-penugasan');
        const btnSimpan = document.getElementById('btn-simpan');

        function updateKonteks() {
            if (!jurusanId || !tingkat) {
                konteksInfo.textContent = 'Pilih jurusan dan tingkat terlebih dahulu.';
                konteksInfo.className = 'alert alert-info mb-0 py-2 small';
                selectKelas.disabled = true;
                selectMapel.disabled = true;
                btnSimpan.disabled = true;
                formMapel.classList.add('d-none');
                return;
            }

            const romawi = { 10: 'X', 11: 'XI', 12: 'XII' }[tingkat];
            konteksInfo.innerHTML = `Anda mengatur: <strong>${romawi} ${jurusanKode}</strong> - mapel & kelas hanya untuk tingkat ini.`;
            konteksInfo.className = 'alert alert-primary mb-0 py-2 small';

            document.getElementById('mapel-jurusan-id').value = jurusanId;
            document.getElementById('mapel-tingkat').value = tingkat;
            formMapel.classList.remove('d-none');

            loadKelas();
            loadMapel();
        }

        function loadKelas() {
            fetch(`{{ route('admin.mapping.kelas') }}?jurusan_id=${jurusanId}&tingkat=${tingkat}`)
                .then(r => r.json())
                .then(data => {
                    selectKelas.innerHTML = '<option value="">- Pilih kelas (rombel) -</option>';
                    if (data.length === 0) {
                        selectKelas.innerHTML += '<option value="" disabled>Belum ada kelas - buat di Kelola Kelas</option>';
                    }
                    data.forEach(k => {
                        selectKelas.innerHTML += `<option value="${k.id}">${k.label}</option>`;
                    });
                    selectKelas.disabled = data.length === 0;
                    btnSimpan.disabled = selectKelas.disabled || selectMapel.disabled;
                });
        }

        function loadMapel() {
            fetch(`{{ route('admin.mapping.mapel') }}?jurusan_id=${jurusanId}&tingkat=${tingkat}`)
                .then(r => r.json())
                .then(data => {
                    selectMapel.innerHTML = '<option value="">- Pilih mapel -</option>';
                    daftarMapel.innerHTML = '';
                    if (data.length === 0) {
                        selectMapel.innerHTML += '<option value="" disabled>Belum ada mapel - tambahkan di panel kiri</option>';
                        daftarMapel.innerHTML = '<li class="list-group-item text-warning">Belum ada mapel untuk tingkat ini.</li>';
                    } else {
                        data.forEach(m => {
                            selectMapel.innerHTML += `<option value="${m.id}">${m.nama}</option>`;
                            daftarMapel.innerHTML += `<li class="list-group-item">${m.nama}</li>`;
                        });
                    }
                    selectMapel.disabled = data.length === 0;
                    btnSimpan.disabled = selectKelas.disabled || selectMapel.disabled;
                });
        }

        document.querySelectorAll('.jurusan-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.jurusan-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                jurusanId = this.dataset.id;
                jurusanKode = this.dataset.kode;
                document.querySelectorAll('.tingkat-btn').forEach(b => b.disabled = false);
                if (tingkat) updateKonteks();
            });
        });

        document.querySelectorAll('.tingkat-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (!jurusanId) return;
                document.querySelectorAll('.tingkat-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                tingkat = this.dataset.tingkat;
                updateKonteks();
            });
        });

        formPenugasan.addEventListener('change', () => {
            btnSimpan.disabled = !selectKelas.value || !selectMapel.value || !formPenugasan.guru_id.value;
        });
    </script>
</body>

</html>
