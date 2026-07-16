<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramPhoto;
use Illuminate\Http\Request;

class ProgramPhotoController extends Controller
{
    public function index(Request $request)
    {
        $jurusan = $request->get('jurusan', 'tjkt');
        $photos = ProgramPhoto::where('jurusan', $jurusan)->latest()->get();
        $jurusanList = ['tjkt' => 'TJKT', 'bdp' => 'BDP', 'tbsm' => 'TBSM'];

        return view('admin.program_photos.index', compact('photos', 'jurusan', 'jurusanList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan' => 'required|in:tjkt,bdp,tbsm',
            'caption' => 'nullable|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $fotoPath = $request->file('foto')->store('program_photos', 'public');

        ProgramPhoto::create([
            'jurusan' => $request->jurusan,
            'caption' => $request->caption,
            'foto' => $fotoPath,
        ]);

        return back()->with('success', 'Foto kegiatan berhasil diupload!');
    }

    public function destroy(ProgramPhoto $photo)
    {
        $path = public_path('storage/' . $photo->foto);
        if (file_exists($path)) {
            unlink($path);
        }
        $photo->delete();

        return back()->with('success', 'Foto berhasil dihapus!');
    }
}