<?php

use App\Http\Controllers\Admin\ProgramPhotoController;
use App\Http\Controllers\Admin\PPDBController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ekskulController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KuisionerController;
use App\Http\Controllers\ProgramKeahlianController;

// ================== HOME ==================
Route::get('/', [NewsController::class, 'home'])->name('home');

Route::get('/visimisi', function () {
    return view('visimisi');
})->name('visimisi');

Route::get('/struktur_organisasi', function () {
    return view('struktur_organisasi');
})->name('struktur_organisasi');

Route::get('/fasilitas', function () {
    return view('fasilitas');
})->name('fasilitas');

Route::get('/ppdb', [App\Http\Controllers\PPDBController::class, 'show'])->name('ppdb');

Route::get('kontak', function () {
    return view('kontak');
})->name('kontak');

Route::get('program_keahlian', [ProgramKeahlianController::class, 'index'])->name('program_keahlian');

Route::get('/jurusan/{jurusan}', [ProgramKeahlianController::class, 'showJurusan'])->name('jurusan.show');

Route::get('/ekstrakurikuler', [ekskulController::class, 'index'])->name('ekstrakurikuler');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

Route::get('/jurusan/tjkt', [ProgramKeahlianController::class, 'showJurusan'])->name('tjkt');
Route::get('/jurusan/bdp', [ProgramKeahlianController::class, 'showJurusan'])->name('bdp');
Route::get('/jurusan/tbsm', [ProgramKeahlianController::class, 'showJurusan'])->name('tbsm');

// ================== LOGIN ==================
Route::get('/sesi', [SesiController::class, 'index'])->name('login');
Route::post('/sesi', [SesiController::class, 'login'])->name('sesi.login');
Route::get('/sesi', [SesiController::class, 'index'])->name('sesi.index');

// Logout
Route::post('logout', [AdminController::class, 'logout'])->name('logout');
Route::post('logout-guru', [GuruController::class, 'logout'])->name('guru.logout');
Route::post('logout-siswa', [SiswaController::class, 'logout'])->name('siswa.logout');

// ================== ADMIN ==================
Route::middleware(['auth', 'role:admin'])->group(function () {

    // kelola siswa
    Route::get('/admin/siswa/create', [AdminController::class, 'createSiswa'])->name('siswa.create');
    Route::post('/admin/siswa', [AdminController::class, 'storeSiswa'])->name('siswa.store');
    Route::get('/admin/siswa/{siswa}/edit', [AdminController::class, 'editSiswa'])->name('siswa.edit');
    Route::put('/admin/siswa/{siswa}', [AdminController::class, 'updateSiswa'])->name('siswa.update');
    Route::delete('/admin/siswa/{siswa}', [AdminController::class, 'destroySiswa'])->name('siswa.destroy');

    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // kelola guru
    Route::get('/admin/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/admin/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::post('/admin/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::delete('/admin/guru/{id}', [GuruController::class, 'destroy'])->name('guru.destroy');
    Route::get('/admin/guru/{id}/edit', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/admin/guru/{id}', [GuruController::class, 'update'])->name('guru.update');

    // berita
    Route::get('/admin/berita', [NewsController::class, 'index'])->name('news.index');
    Route::get('/admin/berita/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/admin/berita', [NewsController::class, 'store'])->name('news.store');
    Route::delete('/admin/berita/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
    Route::get('/admin/berita/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/admin/berita/{id}', [NewsController::class, 'update'])->name('news.update');

    // Ekstrakurikuler
    Route::get('/ekstrakurikuler/tambah', [ekskulController::class, 'create'])->name('ekskul.create');
    Route::post('/tambah-ekskul', [ekskulController::class, 'storeEkskul'])->name('ekskul.store');
    Route::delete('/ekskul/{id}', [ekskulController::class, 'destroy'])->name('ekskul.destroy');
    Route::get('/ekskul/{id}/edit', [ekskulController::class, 'edit'])->name('ekskul.edit');
    Route::put('/ekskul/{id}', [ekskulController::class, 'update'])->name('ekskul.update');

    // galeri
    Route::post('/tambah-gallery', [GalleryController::class, 'storeGallery']);
    Route::get('/gallery_tambah', [GalleryController::class, 'create'])->name('gallery.create');
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    Route::get('/gallery/{id}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');

    // pengumuman
    Route::get('admin/pengumuman/create', [PengumumanController::class, 'create'])->name('admin.pengumuman.create');
    Route::post('admin/pengumuman/store', [PengumumanController::class, 'store'])->name('admin.pengumuman.store');
    Route::get('admin/pengumuman/{pengumuman}/edit', [PengumumanController::class, 'edit'])->name('admin.pengumuman.edit');
    Route::put('admin/pengumuman/{pengumuman}', [PengumumanController::class, 'update'])->name('admin.pengumuman.update');
    Route::delete('admin/pengumuman/{pengumuman}', [PengumumanController::class, 'destroy'])->name('admin.pengumuman.destroy');

    // user management
    Route::get('admin/users/create', [UserController::class, 'createUser'])->name('admin.users.create');
    Route::post('admin/users/store', [UserController::class, 'storeUser'])->name('admin.users.store');

    //Kelas
    Route::get('/admin/kelas', [AdminController::class, 'createKelas'])->name('kelas.index');
    Route::post('/admin/kelas', [AdminController::class, 'storeKelas'])->name('kelas.store');
    Route::get('/admin/kelas/{kelas}/edit', [AdminController::class, 'editKelas'])->name('kelas.edit');
    Route::put('/admin/kelas/{kelas}', [AdminController::class, 'updateKelas'])->name('kelas.update');
    Route::delete('/admin/kelas/{kelas}', [AdminController::class, 'destroyKelas'])->name('kelas.destroy');

    // Mapping pembelajaran (tabel guru_mapel: users + mapels + kelas)
    Route::get('/admin/mapping', [AdminController::class, 'createMapping'])->name('admin.mapping');
    Route::get('/admin/mapping/kelas', [AdminController::class, 'mappingKelas'])->name('admin.mapping.kelas');
    Route::get('/admin/mapping/mapel', [AdminController::class, 'mappingMapel'])->name('admin.mapping.mapel');
    Route::post('/admin/mapping', [AdminController::class, 'storeMapping'])->name('admin.mapping.store');
    Route::delete('/admin/mapping/{mapping}', [AdminController::class, 'destroyMapping'])->name('admin.mapping.destroy');
    Route::post('/admin/mapel', [AdminController::class, 'storeMapel'])->name('admin.mapel.store');

    // Program Photos (Foto Kegiatan Jurusan)
    Route::get('/admin/program-photos', [ProgramPhotoController::class, 'index'])->name('admin.program_photos.index');
    Route::post('/admin/program-photos', [ProgramPhotoController::class, 'store'])->name('admin.program_photos.store');
    Route::delete('/admin/program-photos/{photo}', [ProgramPhotoController::class, 'destroy'])->name('admin.program_photos.destroy');

    // PPDB Waves Management (Gelombang Penerimaan Siswa Baru)
    Route::get('/admin/ppdb', [PPDBController::class, 'index'])->name('admin.ppdb.index');
    Route::get('/admin/ppdb/create', [PPDBController::class, 'create'])->name('admin.ppdb.create');
    Route::post('/admin/ppdb', [PPDBController::class, 'store'])->name('admin.ppdb.store');
    Route::get('/admin/ppdb/{ppdbWave}/edit', [PPDBController::class, 'edit'])->name('admin.ppdb.edit');
    Route::put('/admin/ppdb/{ppdbWave}', [PPDBController::class, 'update'])->name('admin.ppdb.update');
    Route::delete('/admin/ppdb/{ppdbWave}', [PPDBController::class, 'destroy'])->name('admin.ppdb.destroy');
    Route::patch('/admin/ppdb/{ppdbWave}/toggle', [PPDBController::class, 'toggleActive'])->name('admin.ppdb.toggle');
});

// ================== GURU ==================
Route::get('/guru', [GuruController::class, 'indexPublic'])->name('guru.public');

Route::middleware(['auth', 'role:guru'])->group(function () {

    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])
        ->name('guru.dashboard');

    Route::get('/guru/input-nilai', [GuruController::class, 'inputNilai'])
        ->name('guru.input.nilai');

    Route::post('/guru/simpan-nilai', [GuruController::class, 'simpanNilai'])
        ->name('guru.simpan.nilai');

    Route::get('/guru/kinerja', [GuruController::class, 'kinerja'])->name('guru.kinerja');

    Route::get('/guru/get-siswa', [GuruController::class, 'getSiswaByKelas']);

    Route::get('/guru/get-mapel', [GuruController::class, 'getMapelByKelas']);
});

// ================== SISWA ==================
Route::middleware(['auth', 'role:siswa'])->group(function () {

    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])
        ->name('siswa.dashboard');

    Route::get('/siswa/nilai', [SiswaController::class, 'nilai'])->name('siswa.nilai');

    Route::get('/kuisioner', [SiswaController::class, 'kuisionerIndex'])->name('kuisioner.index');
    Route::post('/kuisioner', [SiswaController::class, 'kuisionerStore'])->name('kuisioner.store');
});
