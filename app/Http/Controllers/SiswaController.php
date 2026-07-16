<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\GuruMapel;
use App\Models\Jawaban;
use App\Models\Kuisioner;
use App\Models\Nilai;
use App\Models\Pengumuman;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('sesi.index');
    }

    public function dashboard()
    {
        $pengumuman = Pengumuman::with('user')
            ->whereIn('target', ['semua', 'siswa'])
            ->where(function ($query) {
                $query->whereNull('expired_at')
                    ->orWhere('expired_at', '>=', now());
            })
            ->latest()
            ->get();

        $siswa = Auth::user()->siswa;

        return view('siswa.dashboard', compact('pengumuman', 'siswa'));
    }

    public function nilai()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            return redirect()->route('siswa.dashboard')
                ->withErrors(['siswa' => 'Akun Anda belum terdaftar di kelas. Hubungi admin.']);
        }

        $tahunAjaran = TahunAjaran::aktif();

        // Ambil semua nilai siswa, di-group per mapel & semester
        $rawNilai = Nilai::with(['mapel', 'guru', 'tahunAjaran'])
            ->where('siswa_id', $siswa->id)
            ->when($tahunAjaran, fn($q) => $q->where('tahun_ajaran_id', $tahunAjaran->id))
            ->orderBy('semester')
            ->orderBy('mapel_id')
            ->orderBy('jenis_nilai')
            ->get();

        // Pivot: group by [mapel_id][semester]
        $byMapel = [];
        foreach ($rawNilai as $n) {
            $m = $n->mapel_id;
            $s = $n->semester;
            if (!isset($byMapel[$m])) {
                $byMapel[$m] = [
                    'mapel' => $n->mapel,
                    'guru'  => $n->guru,
                    'semesters' => [],
                ];
            }
            if (!isset($byMapel[$m]['semesters'][$s])) {
                $byMapel[$m]['semesters'][$s] = [
                    'tugas' => null,
                    'quiz'  => null,
                    'uts'   => null,
                    'uas'   => null,
                ];
            }
            $jenis = $n->jenis_nilai;
            $byMapel[$m]['semesters'][$s][$jenis] = $n->nilai;
        }

        return view('siswa.nilai', compact('siswa', 'byMapel', 'tahunAjaran'));
    }

    public function kuisionerIndex()
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            return redirect()->route('siswa.dashboard')
                ->withErrors(['siswa' => 'Akun Anda belum terdaftar di kelas. Hubungi admin.']);
        }

        $tahunAjaran = TahunAjaran::aktif();

        // Guru yang mengajar di kelas siswa - ambil user_id dari GuruMapel
        $guruUserIds = GuruMapel::where('kelas_id', $siswa->kelas_id)
            ->pluck('guru_id')
            ->unique();

        // Ambil data User (guru) dengan relasi ke Guru model untuk nama_lengkap
        $guruList = DB::table('users')
            ->whereIn('users.id', $guruUserIds)
            ->leftJoin('guru', 'users.id', '=', 'guru.user_id')
            ->select('users.id', 'users.name', 'guru.nama')
            ->get()
            ->map(fn($u) => (object)[
                'id'           => $u->id,
                'nama_lengkap' => $u->nama ?? $u->name,
            ]);

        // Cek guru yang sudah dinilai siswa ini di tahun ajaran aktif
        $sudahDinilai = Jawaban::where('siswa_id', $siswa->id)
            ->when($tahunAjaran, fn($q) => $q->where('tahun_ajaran_id', $tahunAjaran->id))
            ->pluck('guru_id')
            ->unique()
            ->toArray();

        $pertanyaan = Kuisioner::aktif()->get();

        return view('siswa.kuisioner', compact('siswa', 'guruList', 'sudahDinilai', 'pertanyaan', 'tahunAjaran'));
    }

    public function kuisionerStore(Request $request)
    {
        $siswa = Auth::user()->siswa;

        if (!$siswa) {
            return back()->withErrors(['siswa' => 'Akun Anda belum terdaftar di kelas.']);
        }

        $request->validate([
            'guru_id'  => 'required|exists:users,id',
            'nilai'    => 'required|array',
            'nilai.*'  => 'required|integer|min:1|max:5',
        ]);

        $tahunAjaran = TahunAjaran::aktif();

        // Validasi: guru harus mengajar di kelas siswa
        $terdaftar = GuruMapel::where('kelas_id', $siswa->kelas_id)
            ->where('guru_id', $request->guru_id)
            ->exists();

        if (!$terdaftar) {
            return back()->withErrors(['guru_id' => 'Guru tidak mengajar di kelas Anda.'])
                ->withInput();
        }

        // Simpan setiap jawaban
        $saved = 0;
        foreach ($request->nilai as $kuisionerId => $nilai) {
            Jawaban::updateOrCreate(
                [
                    'siswa_id'       => $siswa->id,
                    'guru_id'       => $request->guru_id,
                    'kuisioner_id'  => $kuisionerId,
                    'user_id'       => Auth::id(),
                    'tahun_ajaran_id' => $tahunAjaran?->id,
                ],
                [
                    'nilai' => $nilai,
                ]
            );
            $saved++;
        }

        return redirect()
            ->route('kuisioner.index')
            ->with('success', "Penilaian untuk guru berhasil disimpan ({$saved} pertanyaan).");
    }
}