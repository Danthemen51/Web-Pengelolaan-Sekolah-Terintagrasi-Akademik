<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\GuruMapel;
use App\Models\Jawaban;
use App\Models\Kuisioner;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KuisionerController extends Controller
{
    public function index()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            return redirect()->route('siswa.dashboard')
                ->withErrors(['siswa' => 'Anda belum terdaftar di kelas. Hubungi admin untuk penempatan kelas.']);
        }

        $pertanyaan = Kuisioner::aktif()->get();

        $guruUserIds = GuruMapel::where('kelas_id', $siswa->kelas_id)
            ->pluck('guru_id')
            ->unique();

        $guru = Guru::with('user')
            ->whereIn('user_id', $guruUserIds)
            ->get();

        $tahunAjaran = TahunAjaran::aktif();

        $sudahDinilai = [];
        if ($tahunAjaran) {
            $sudahDinilai = Jawaban::where('siswa_id', $siswa->id)
                ->where('tahun_ajaran_id', $tahunAjaran->id)
                ->pluck('guru_id')
                ->unique()
                ->all();
        }

        return view('siswa.kuisioner', compact('pertanyaan', 'guru', 'siswa', 'sudahDinilai', 'tahunAjaran'));
    }

    public function store(Request $request)
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            return back()->withErrors(['siswa' => 'Data siswa tidak ditemukan.']);
        }

        $request->validate([
            'guru_id' => 'required|exists:users,id',
            'nilai' => 'required|array',
            'nilai.*' => 'required|integer|min:1|max:5',
        ]);

        // guru_id adalah users.id, validasi bahwa guru mengajar di kelas
        $mengajarKelas = GuruMapel::where('guru_id', $request->guru_id)
            ->where('kelas_id', $siswa->kelas_id)
            ->exists();

        if (!$mengajarKelas) {
            return back()->withErrors(['guru_id' => 'Guru ini tidak mengajar di kelas Anda.']);
        }

        $tahunAjaran = TahunAjaran::aktif();
        if (!$tahunAjaran) {
            return back()->withErrors(['tahun_ajaran' => 'Tahun ajaran aktif belum dikonfigurasi.']);
        }

        $sudah = Jawaban::where('siswa_id', $siswa->id)
            ->where('guru_id', $request->guru_id)
            ->where('tahun_ajaran_id', $tahunAjaran->id)
            ->exists();

        if ($sudah) {
            return back()->with('error', 'Anda sudah menilai guru ini pada tahun ajaran ini.');
        }

        $pertanyaanAktif = Kuisioner::aktif()->pluck('id');
        foreach ($request->nilai as $kuisionerId => $nilai) {
            if (!$pertanyaanAktif->contains((int) $kuisionerId)) {
                continue;
            }

            Jawaban::create([
                'siswa_id' => $siswa->id,
                'user_id' => Auth::id(),
                'guru_id' => $request->guru_id,
                'kuisioner_id' => $kuisionerId,
                'tahun_ajaran_id' => $tahunAjaran->id,
                'nilai' => $nilai,
            ]);
        }

        return redirect()->route('kuisioner.index')->with('success', 'Terima kasih! Penilaian kinerja guru berhasil dikirim.');
    }
}
