<?php

namespace App\Http\Controllers;

use App\Models\Gallery; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('gallery', compact('galleries'));
    }

    public function create()
    {
        $galleries = Gallery::latest()->get();
        return view('gallery_create', compact('galleries'));
    }

    public function storeGallery(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048', 
            'description' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
        }

        Gallery::create([
            'title' => $request->title,
            'image' => $path,
            'description' => $request->description
        ]);

        return back()->with('success', 'Foto berhasil ditambahkan ke Galeri!');
    }

    public function destroy($id)
    {
        $galleries = Gallery::findOrFail($id);

        // Hapus file gambar dari folder storage jika ada
        if ($galleries->image) {
            Storage::disk('public')->delete($galleries->image);
        }

        $galleries->delete();

        return back()->with('success', 'Foto berhasil dihapus!');
    }

    public function edit($id)
    {
        $galleries = Gallery::findOrFail($id);
        return view('gallery_edit', compact('galleries'));
    }
    public function update(Request $request, $id)
    {
        $galleries = Gallery::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            // Hapus file gambar lama jika ada
            if ($galleries->image) {
                Storage::disk('public')->delete($galleries->image);
            }
            $validated['image'] = $request->file('image')->store('gallery', 'public');
        }

        $galleries->update($validated);

        return redirect()->route('gallery.create')->with('success', 'Foto berhasil diperbarui!');
    }
}