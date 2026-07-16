<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guru;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Ekstrakurikuler;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Mapel;
use App\Models\GuruMapel;
use App\Models\Jurusan;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalSiswa = Siswa::count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalEkskul = Ekstrakurikuler::count();
        $totalPengumuman = Pengumuman::count();
        $recentPengumuman = Pengumuman::orderBy('created_at', 'desc')->limit(5)->get();
        return view('admin.dashboard', compact('totalSiswa', 'totalGuru', 'totalEkskul', 'totalPengumuman', 'recentPengumuman'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('sesi.index');
    }


    public function createSiswa()
    {
        $users = User::query()
            ->where('role', 'siswa')
            ->whereDoesntHave('siswa')
            ->orderBy('name')
            ->get();

        $kelas = $this->kelasDenganSiswa();
        $totalSiswa = Siswa::count();

        return view('admin.tambah_siswa', compact('users', 'kelas', 'totalSiswa'));
    }

    public function storeSiswa(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id', 'unique:siswas,user_id'],
            'kelas_id' => ['required', 'exists:kelas,id'],
            'nisn' => ['nullable', 'string', 'max:20', 'unique:siswas,nisn'],
        ]);

        $user = User::findOrFail($request->user_id);
        if ($user->role !== 'siswa') {
            return back()->withErrors(['user_id' => 'Akun yang dipilih bukan role siswa.']);
        }

        Siswa::create([
            'user_id' => $request->user_id,
            'kelas_id' => $request->kelas_id,
            'nisn' => $request->nisn,
        ]);

        return back()->with('success', 'Siswa berhasil ditambahkan ke kelas!');
    }

    public function editSiswa(Siswa $siswa)
    {
        $siswa->load(['user', 'kelas.jurusan']);
        $kelas = Kelas::with('jurusan')->orderBy('tingkat')->orderBy('nama')->get();

        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    public function updateSiswa(Request $request, Siswa $siswa)
    {
        $request->validate([
            'kelas_id' => ['required', 'exists:kelas,id'],
            'nisn' => ['nullable', 'string', 'max:20', 'unique:siswas,nisn,' . $siswa->id],
        ]);

        $siswa->update([
            'kelas_id' => $request->kelas_id,
            'nisn' => $request->nisn,
        ]);

        return redirect()->route('siswa.create')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroySiswa(Siswa $siswa)
    {
        $siswa->delete();

        return back()->with('success', 'Data siswa berhasil dihapus dari kelas. Akun login tetap ada.');
    }


    public function createKelas()
    {
        $kelas = $this->kelasDenganSiswa();
        $jurusan = Jurusan::orderBy('kode')->get();
        $totalSiswa = Siswa::count();

        return view('admin.kelas', compact('kelas', 'jurusan', 'totalSiswa'));
    }

    public function storeKelas(Request $request)
    {
        $request->validate([
            'jurusan_id' => ['required', 'exists:jurusan,id'],
            'tingkat' => ['required', 'in:10,11,12'],
            'rombel' => ['required', 'string', 'max:10'],
        ]);

        $nama = Kelas::generateNama(
            (int) $request->jurusan_id,
            (int) $request->tingkat,
            $request->rombel
        );

        $duplikat = Kelas::query()
            ->where('jurusan_id', $request->jurusan_id)
            ->where('tingkat', $request->tingkat)
            ->where('rombel', $request->rombel)
            ->exists();

        if ($duplikat) {
            return back()->withErrors([
                'rombel' => "Kelas {$nama} sudah terdaftar untuk jurusan dan tingkat ini.",
            ]);
        }

        Kelas::create([
            'jurusan_id' => $request->jurusan_id,
            'tingkat' => $request->tingkat,
            'rombel' => $request->rombel,
            'nama' => $nama,
        ]);

        return back()->with('success', "Kelas {$nama} berhasil ditambahkan.");
    }

    public function editKelas(Kelas $kelas)
    {
        $kelasData = $this->kelasDenganSiswa();
        $jurusan = Jurusan::orderBy('kode')->get();
        $totalSiswa = Siswa::count();

        return view('admin.kelas', [
            'kelas' => $kelasData,
            'jurusan' => $jurusan,
            'editKelas' => $kelas,
            'totalSiswa' => $totalSiswa,
        ]);
    }

    private function kelasDenganSiswa()
    {
        return Kelas::with([
            'jurusan',
            'siswas' => fn ($query) => $query->with('user'),
        ])
            ->withCount('siswas')
            ->orderBy('tingkat')
            ->orderBy('nama')
            ->get();
    }

    public function updateKelas(Request $request, Kelas $kelas)
    {
        $request->validate([
            'jurusan_id' => ['required', 'exists:jurusan,id'],
            'tingkat' => ['required', 'in:10,11,12'],
            'rombel' => ['required', 'string', 'max:10'],
        ]);

        $nama = Kelas::generateNama(
            (int) $request->jurusan_id,
            (int) $request->tingkat,
            $request->rombel
        );

        $duplikat = Kelas::query()
            ->where('id', '!=', $kelas->id)
            ->where('jurusan_id', $request->jurusan_id)
            ->where('tingkat', $request->tingkat)
            ->where('rombel', $request->rombel)
            ->exists();

        if ($duplikat) {
            return back()->withErrors([
                'rombel' => "Kelas {$nama} sudah terdaftar untuk jurusan dan tingkat ini.",
            ]);
        }

        $kelas->update([
            'jurusan_id' => $request->jurusan_id,
            'tingkat' => $request->tingkat,
            'rombel' => $request->rombel,
            'nama' => $nama,
        ]);

        return redirect()->route('kelas.index')->with('success', "Kelas {$nama} berhasil diperbarui.");
    }

    public function destroyKelas(Kelas $kelas)
    {
        $nama = $kelas->nama;
        $kelas->delete();

        return back()->with('success', "Kelas {$nama} berhasil dihapus.");
    }

    public function createMapping()
    {
        $guru = User::query()->where('role', 'guru')->orderBy('name')->get();
        $jurusan = Jurusan::orderBy('kode')->get();
        $mappings = GuruMapel::with(['guru', 'mapel.jurusan', 'kelas.jurusan'])
            ->latest()
            ->get();

        return view('admin.mapping', compact('guru', 'jurusan', 'mappings'));
    }

    public function mappingKelas(Request $request)
    {
        $request->validate([
            'jurusan_id' => ['required', 'exists:jurusan,id'],
            'tingkat' => ['required', 'in:10,11,12'],
        ]);

        $kelas = Kelas::with('jurusan')
            ->where('jurusan_id', $request->jurusan_id)
            ->where('tingkat', $request->tingkat)
            ->orderBy('rombel')
            ->get()
            ->map(fn (Kelas $k) => [
                'id' => $k->id,
                'label' => $k->label,
                'rombel' => $k->rombel,
            ]);

        return response()->json($kelas);
    }

    public function mappingMapel(Request $request)
    {
        $request->validate([
            'jurusan_id' => ['required', 'exists:jurusan,id'],
            'tingkat' => ['required', 'in:10,11,12'],
        ]);

        $mapel = Mapel::with('jurusan')
            ->where('jurusan_id', $request->jurusan_id)
            ->where('tingkat', $request->tingkat)
            ->orderBy('nama')
            ->get()
            ->map(fn (Mapel $m) => [
                'id' => $m->id,
                'nama' => $m->nama,
                'konteks' => $m->konteks,
            ]);

        return response()->json($mapel);
    }

    public function storeMapel(Request $request)
    {
        $request->validate([
            'nama' => [
                'required',
                'string',
                'max:255',
                Rule::unique('mapels', 'nama')
                    ->where('jurusan_id', $request->jurusan_id)
                    ->where('tingkat', $request->tingkat),
            ],
            'jurusan_id' => ['required', 'exists:jurusan,id'],
            'tingkat' => ['required', 'in:10,11,12'],
        ]);

        Mapel::create([
            'nama' => $request->nama,
            'jurusan_id' => $request->jurusan_id,
            'tingkat' => $request->tingkat,
        ]);

        $jurusan = Jurusan::find($request->jurusan_id);
        $tingkatLabel = Kelas::tingkatRomawi((int) $request->tingkat);

        return back()->with(
            'success',
            "Mapel \"{$request->nama}\" untuk {$tingkatLabel} " . strtoupper($jurusan->kode) . ' berhasil ditambahkan.'
        );
    }

    public function storeMapping(Request $request)
    {
        $request->validate([
            'guru_id' => ['required', 'exists:users,id'],
            'mapel_id' => ['required', 'exists:mapels,id'],
            'kelas_id' => ['required', 'exists:kelas,id'],
        ]);

        $kelas = Kelas::findOrFail($request->kelas_id);
        $mapel = Mapel::findOrFail($request->mapel_id);

        if (!$kelas->jurusan_id || !$kelas->tingkat) {
            return back()->withErrors([
                'kelas_id' => 'Kelas belum memiliki jurusan/tingkat. Perbarui data kelas di menu Kelola Kelas.',
            ]);
        }

        if ($mapel->jurusan_id !== $kelas->jurusan_id || (int) $mapel->tingkat !== (int) $kelas->tingkat) {
            return back()->withErrors([
                'mapel_id' => 'Mapel ini tidak untuk jurusan/tingkat yang sama dengan kelas yang dipilih. '
                    . 'Mapel X TJKT tidak bisa dipakai untuk kelas XI TJKT.',
            ]);
        }

        $exists = GuruMapel::query()
            ->where('guru_id', $request->guru_id)
            ->where('mapel_id', $request->mapel_id)
            ->where('kelas_id', $request->kelas_id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors(['mapping' => 'Penugasan ini sudah ada: guru yang sama sudah mengajar mapel tersebut di kelas tersebut.']);
        }

        GuruMapel::create([
            'guru_id' => $request->guru_id,
            'mapel_id' => $request->mapel_id,
            'kelas_id' => $request->kelas_id,
        ]);

        return back()->with('success', 'Penugasan mengajar berhasil disimpan.');
    }

    public function destroyMapping(GuruMapel $mapping)
    {
        $mapping->delete();

        return back()->with('success', 'Penugasan mengajar berhasil dihapus.');
    }
}
