<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    @include('partial.navbar_guru')

    <div class="container py-4">
        <h2 class="fw-bold mb-1">Input Nilai Siswa</h2>
        <p class="text-muted small mb-4">
            Hanya kelas & mapel dari penugasan Anda (<code>guru_mapel</code>).
            @if($tahunAjaran) Tahun ajaran: <strong>{{ $tahunAjaran->nama }}</strong> @endif
        </p>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        @if ($kelas->isEmpty())
            <div class="alert alert-warning">Belum ada penugasan mengajar. Hubungi admin untuk mapping di menu Mapping Pembelajaran.</div>
        @else
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('guru.simpan.nilai') }}" id="form-nilai">
                        @csrf
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Kelas</label>
                                <select id="kelas" class="form-select" required>
                                    <option value="">- Pilih kelas -</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id }}">{{ $k->label ?? $k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Mata Pelajaran</label>
                                <select name="mapel_id" id="mapel" class="form-select" required disabled>
                                    <option value="">- Pilih kelas dulu -</option>
                                </select>
                                <input type="hidden" name="kelas_id" id="kelas_id_hidden">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Jenis Nilai</label>
                                <select name="jenis_nilai" class="form-select" required>
                                    <option value="tugas">Tugas</option>
                                    <option value="quiz">Quiz</option>
                                    <option value="uts">UTS</option>
                                    <option value="uas">UAS</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Semester</label>
                                <select name="semester" class="form-select" required>
                                    <option value="ganjil">Ganjil</option>
                                    <option value="genap">Genap</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="tabelSiswa">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th width="120">Nilai (0-100)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2" class="text-muted text-center">Pilih kelas terlebih dahulu</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3" id="btn-simpan" disabled>Simpan Nilai</button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <script>
        const csrf = document.querySelector('meta[name="csrf-token"]').content;
        const kelasSelect = document.getElementById('kelas');
        const mapelSelect = document.getElementById('mapel');
        const kelasHidden = document.getElementById('kelas_id_hidden');
        const btnSimpan = document.getElementById('btn-simpan');

        kelasSelect?.addEventListener('change', function() {
            const kelasId = this.value;
            kelasHidden.value = kelasId;
            const tbody = document.querySelector('#tabelSiswa tbody');

            if (!kelasId) {
                mapelSelect.innerHTML = '<option value="">- Pilih kelas dulu -</option>';
                mapelSelect.disabled = true;
                tbody.innerHTML = '<tr><td colspan="2" class="text-muted text-center">Pilih kelas</td></tr>';
                btnSimpan.disabled = true;
                return;
            }

            fetch(`/guru/get-mapel?kelas_id=${kelasId}`, { headers: { 'Accept': 'application/json' } })
                .then(r => r.json())
                .then(data => {
                    mapelSelect.innerHTML = '<option value="">- Pilih mapel -</option>';
                    data.forEach(m => mapelSelect.innerHTML += `<option value="${m.id}">${m.nama}</option>`);
                    mapelSelect.disabled = data.length === 0;
                });

            fetch(`/guru/get-siswa?kelas_id=${kelasId}`, { headers: { 'Accept': 'application/json' } })
                .then(r => r.json())
                .then(data => {
                    if (!data.length) {
                        tbody.innerHTML = '<tr><td colspan="2" class="text-warning text-center">Tidak ada siswa di kelas ini</td></tr>';
                        btnSimpan.disabled = true;
                        return;
                    }
                    tbody.innerHTML = '';
                    data.forEach(s => {
                        tbody.innerHTML += `<tr>
                            <td>${s.user.name}</td>
                            <td><input type="number" name="nilai[${s.id}]" class="form-control form-control-sm" min="0" max="100"></td>
                        </tr>`;
                    });
                    btnSimpan.disabled = false;
                });
        });
    </script>
</body>
</html>