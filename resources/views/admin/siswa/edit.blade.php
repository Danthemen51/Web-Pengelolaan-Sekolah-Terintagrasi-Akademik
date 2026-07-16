<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
</head>

<body>
    @include('partial.navbar_admin')

    <div class="main-content p-4">
        <div class="container-fluid">
            <h2 class="mb-3">Edit Siswa</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">{{ $siswa->user?->name }}</h5>
                            <small class="opacity-75">{{ $siswa->user?->email }}</small>
                        </div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('siswa.update', $siswa) }}">
                                @csrf
                                @method('PUT')

                                {{-- <div class="mb-3">
                                    <label class="form-label">NISN</label>
                                    <input type="text" name="nisn" class="form-control"
                                        value="{{ old('nisn', $siswa->nisn) }}" placeholder="10 digit">
                                    <div class="form-text">Opsional. Harus unik jika diisi.</div>
                                </div> --}}

                                <div class="mb-3">
                                    <label class="form-label">Kelas</label>
                                    <select name="kelas_id" class="form-select" required>
                                        @foreach ($kelas as $k)
                                            <option value="{{ $k->id }}"
                                                @selected(old('kelas_id', $siswa->kelas_id) == $k->id)>
                                                {{ $k->label ?? $k->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-text">
                                        Saat ini: {{ $siswa->kelas?->label ?? $siswa->kelas?->nama ?? '-' }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ old('email', $siswa->user?->email) }}" placeholder="Email">
                                    <div class="form-text">Opsional. Harus unik jika diisi.</div>
                                    
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <a href="{{ route('siswa.create') }}" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>