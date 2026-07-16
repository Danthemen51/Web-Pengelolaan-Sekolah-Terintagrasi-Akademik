<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\GuruMapel;
use App\Models\Jawaban;
use App\Models\Kelas;
use App\Models\Kuisioner;
use App\Models\Nilai;
use App\Models\Pengumuman;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function index()
    {
        return redirect()->route('guru.create');
    }

    public function create()
    {
        $data = Guru::all();
        return view('guru_create', compact('data'));
    }

    public function indexPublic()
    {
        $dataGuru = Guru::all();
        return view('guru', compact('dataGuru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nuptk' => 'nullable|string|max:20',
            'jabatan' => 'required|string|max:255',
            'status' => 'required|in:PNS,PPPK,Honorer,GTY',
            'tahun_mulai' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $nama_foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('foto_guru'), $nama_foto);
        }

        Guru::create([
            'nama' => $request->nama,
            'nuptk' => $request->nuptk,
            'jabatan' => $request->jabatan,
            'status' => $request->status,
            'tahun_mulai' => $request->tahun_mulai,
            'foto' => $nama_foto,
        ]);

        return back()->with('success', 'Guru berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);

        if ($guru->foto) {
            $fotoPath = public_path('foto_guru/' . $guru->foto);
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }

        $guru->delete();

        return back()->with('success', 'Guru berhasil dihapus!');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru_edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nuptk' => 'nullable|string|max:20',
            'jabatan' => 'required|string|max:255',
            'status' => 'required|in:PNS,PPPK,Honorer,GTY',
            'tahun_mulai' => 'required|integer',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($guru->foto) {
                $fotoPath = public_path('foto_guru/' . $guru->foto);
                if (file_exists($fotoPath)) {
                    unlink($fotoPath);
                }
            }

            $foto = $request->file('foto');
            $nama_foto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('foto_guru'), $nama_foto);
            $guru->foto = $nama_foto;
        }

        $guru->nama = $request->nama;
        $guru->nuptk = $request->nuptk;
        $guru->jabatan = $request->jabatan;
        $guru->status = $request->status;
        $guru->tahun_mulai = $request->tahun_mulai;
        $guru->save();

        return redirect()->route('guru.create')->with('success', 'Perubahan berhasil disimpan.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('sesi.index');
    }

    public function dashboard()
    {
        $pengumuman = $this->pengumumanUntukGuru();
        $kinerja = $this->ringkasanKinerja();

        return view('guru.dashboard', compact('pengumuman', 'kinerja'));
    }

    public function kinerja()
    {
        $guru = Guru::where('user_id', Auth::id())->first();
        if (!$guru) {
            $guru = new Guru(["nama" => Auth::user()->name]);
        }

        $kinerja = $this->ringkasanKinerja($guru);
        $pertanyaan = Kuisioner::aktif()->get();

        return view('guru.kinerja', compact('guru', 'kinerja', 'pertanyaan'));
    }

    public function inputNilai()
    {
        $kelasIds = GuruMapel::where('guru_id', Auth::id())->pluck('kelas_id')->unique();

        $kelas = Kelas::with('jurusan')
            ->whereIn('id', $kelasIds)
            ->orderBy('tingkat')
            ->orderBy('nama')
            ->get();

        $tahunAjaran = TahunAjaran::aktif();

        return view('guru.input_nilai', compact('kelas', 'tahunAjaran'));
    }

    public function simpanNilai(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapels,id',
            'jenis_nilai' => 'required|in:tugas,uts,uas,quiz',
            'semester' => 'required|in:ganjil,genap',
            'nilai' => 'required|array',
            'nilai.*' => 'nullable|integer|min:0|max:100',
        ]);

        $mapping = GuruMapel::where('guru_id', Auth::id())
            ->where('kelas_id', $request->kelas_id)
            ->where('mapel_id', $request->mapel_id)
            ->first();

        if (!$mapping) {
            return back()->withErrors(['mapel_id' => 'Anda tidak ditugaskan mengajar mapel ini di kelas tersebut.']);
        }

        $tahunAjaran = TahunAjaran::aktif();
        if (!$tahunAjaran) {
            return back()->withErrors(['tahun_ajaran' => 'Tahun ajaran aktif belum dikonfigurasi.']);
        }

        $saved = 0;
        foreach ($request->nilai as $siswaId => $nilai) {
            if ($nilai === null || $nilai === '') {
                continue;
            }

            Nilai::updateOrCreate(
                [
                    'mapping_id' => $mapping->id,
                    'siswa_id' => $siswaId,
                    'jenis_nilai' => $request->jenis_nilai,
                    'semester' => $request->semester,
                ],
                [
                    'tahun_ajaran_id' => $tahunAjaran->id,
                    'guru_id' => Auth::id(),
                    'mapel_id' => $request->mapel_id,
                    'nilai' => $nilai,
                ]
            );
            $saved++;
        }

        if ($saved === 0) {
            return back()->withErrors(['nilai' => 'Isi minimal satu nilai siswa.']);
        }

        return back()->with('success', "Berhasil menyimpan {$saved} nilai.");
    }

    public function getSiswaByKelas(Request $request)
    {
        $request->validate(['kelas_id' => 'required|exists:kelas,id']);

        $assigned = GuruMapel::where('guru_id', Auth::id())
            ->where('kelas_id', $request->kelas_id)
            ->exists();

        if (!$assigned) {
            return response()->json(['error' => 'Kelas tidak ada dalam penugasan Anda.'], 403);
        }

        $siswa = Siswa::with('user')
            ->where('kelas_id', $request->kelas_id)
            ->get()
            ->map(fn ($s) => [
                'id' => $s->id,
                'user' => ['name' => $s->user?->name ?? '—'],
            ]);

        return response()->json($siswa);
    }

    public function getMapelByKelas(Request $request)
    {
        $request->validate(['kelas_id' => 'required|exists:kelas,id']);

        $mapel = DB::table('guru_mapel')
            ->join('mapels', 'guru_mapel.mapel_id', '=', 'mapels.id')
            ->where('guru_mapel.guru_id', Auth::id())
            ->where('guru_mapel.kelas_id', $request->kelas_id)
            ->select('mapels.id', 'mapels.nama')
            ->orderBy('mapels.nama')
            ->get();

        return response()->json($mapel);
    }

    private function pengumumanUntukGuru()
    {
        return Pengumuman::with('user')
            ->whereIn('target', ['semua', 'guru'])
            ->where(function ($query) {
                $query->whereNull('expired_at')
                    ->orWhere('expired_at', '>=', now());
            })
            ->latest()
            ->get();
    }

    private function ringkasanKinerja(?Guru $guru = null): array
    {
        $guru = $guru ?? Guru::where('user_id', Auth::id())->first();

        if (!$guru) {
            return [
                'total_responden' => 0,
                'rata_keseluruhan' => null,
                'per_pertanyaan' => [],
            ];
        }

        $tahunAjaran = TahunAjaran::aktif();
        $guruUserId = $guru?->user_id ?? Auth::id();
        $guruLegacyId = $guru?->id;

        $query = Jawaban::query();
        if ($guruLegacyId && $guruLegacyId !== $guruUserId) {
            $query->whereIn('guru_id', [$guruUserId, $guruLegacyId]);
        } else {
            $query->where('guru_id', $guruUserId);
        }

        if ($tahunAjaran) {
            $query->where('tahun_ajaran_id', $tahunAjaran->id);
        }

        $jawaban = $query->get();
        $totalResponden = $jawaban->pluck('siswa_id')->unique()->count();

        $perPertanyaan = Kuisioner::aktif()->get()->map(function ($p) use ($jawaban) {
            $nilaiPertanyaan = $jawaban->where('kuisioner_id', $p->id)->pluck('nilai');
            return [
                'pertanyaan' => $p->pertanyaan,
                'rata' => $nilaiPertanyaan->isNotEmpty() ? round($nilaiPertanyaan->avg(), 2) : null,
                'jumlah' => $nilaiPertanyaan->count(),
            ];
        });

        return [
            'total_responden' => $totalResponden,
            'rata_keseluruhan' => $jawaban->isNotEmpty() ? round($jawaban->avg('nilai'), 2) : null,
            'per_pertanyaan' => $perPertanyaan,
            'tahun_ajaran' => $tahunAjaran?->nama,
        ];
    }
}
