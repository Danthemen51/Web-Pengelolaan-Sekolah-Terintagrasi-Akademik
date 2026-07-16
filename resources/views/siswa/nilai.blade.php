<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai Saya</title>
</head>
<body>
    @include('partial.navbar_siswa')

    <div class="container py-4">
        <h2 class="fw-bold mb-1">Nilai Saya</h2>
        <p class="text-muted small mb-4">
            Kelas: <strong>{{ $siswa->kelas?->label ?? '-' }}</strong>
            @if($tahunAjaran) &mdash; {{ $tahunAjaran->nama }} @endif
            &mdash; Data dari tabel <code>nilais</code>.
        </p>

        @if(empty($byMapel))
            <div class="alert alert-info">
                Belum ada nilai yang diinput oleh guru. Hubungi guru mata pelajaran masing-masing.
            </div>
        @else
            @foreach($byMapel as $mapelId => $item)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white fw-bold">
                        {{ $item['mapel']->nama ?? 'Mapel tidak ditemukan' }}
                        <span class="text-muted fw-normal small ms-2">
                            &mdash; {{ $item['guru']->name ?? 'Guru belum diassign' }}
                        </span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>Semester</th>
                                        <th>Tugas</th>
                                        <th>Quiz</th>
                                        <th>UTS</th>
                                        <th>UAS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $jenisList = ['tugas', 'quiz', 'uts', 'uas'];
                                        $jenisLabel = ['tugas' => 'Tugas', 'quiz' => 'Quiz', 'uts' => 'UTS', 'uas' => 'UAS'];
                                        $jenisColors = ['tugas' => 'secondary', 'quiz' => 'info', 'uts' => 'warning', 'uas' => 'success'];
                                    @endphp

                                    @foreach($item['semesters'] as $semester => $nilaiData)
                                        <tr class="text-center align-middle">
                                            <td class="text-start fw-semibold" style="min-width:120px;">
                                                {{ ucfirst($semester) }}
                                            </td>
                                            @foreach($jenisList as $jenis)
                                                <td style="min-width:90px;">
                                                    @if($nilaiData[$jenis] !== null)
                                                        <span class="badge bg-{{ $jenisColors[$jenis] }} fs-6">
                                                            {{ $nilaiData[$jenis] }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted small">-</span>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>