<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ekskulController extends Controller
{
    public function index()
    {
        $ekskuls = Ekstrakurikuler::all();
        return view('ekskul', compact('ekskuls'));
    }

    public function create()
    {
        $ekskuls = Ekstrakurikuler::all();
        return view('ekskul_create', compact('ekskuls'));
    }

    public function storeEkskul(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'required'
        ]);

        $ekskul = new Ekstrakurikuler();
        $ekskul->name = $request->name;
        $ekskul->coach = $request->coach;
        $ekskul->schedule = $request->schedule;
        $ekskul->description = $request->description;

        if ($request->hasFile('image')) {
            $ekskul->image = $this->simpanFotoEkskul($request->file('image'));
        }

        $ekskul->save();

        return back()->with('success', 'Ekstrakurikuler berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $ekskuls = Ekstrakurikuler::findOrFail($id);
        $this->hapusFotoEkskul($ekskuls->image);
        $ekskuls->delete();

        return back()->with('success', 'Ekstrakurikuler berhasil dihapus!');
    }

    public function edit($id)
    {
        $ekskuls = Ekstrakurikuler::findOrFail($id);
        return view('ekskul_edit', compact('ekskuls'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'required'
        ]);

        $ekskuls = Ekstrakurikuler::findOrFail($id);

        if ($request->hasFile('image')) {
            $this->hapusFotoEkskul($ekskuls->image);
            $ekskuls->image = $this->simpanFotoEkskul($request->file('image'));
        }

        $ekskuls->name = $request->name;
        $ekskuls->coach = $request->coach;
        $ekskuls->schedule = $request->schedule;
        $ekskuls->description = $request->description;
        $ekskuls->save();

        return back()->with('success', 'Ekstrakurikuler berhasil diperbarui!');
    }

    private function direktoriFotoEkskul(): string
    {
        $dir = public_path('foto_ekskul');
        if (!File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        return $dir;
    }

    private function simpanFotoEkskul($file): string
    {
        $namaFile = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
        $file->move($this->direktoriFotoEkskul(), $namaFile);

        return $namaFile;
    }

    private function hapusFotoEkskul(?string $image): void
    {
        if (!$image) {
            return;
        }

        $path = public_path('foto_ekskul/' . basename($image));
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
