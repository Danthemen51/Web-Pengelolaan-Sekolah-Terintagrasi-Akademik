<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function home()
    {
        $news = News::latest()->paginate(6);

        return view('welcome', compact('news'));
    }

    public function create()
    {
        $news = News::latest()->get();

        return view('berita_create', compact('news'));
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        return view('news-detail', compact('news'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:news',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'excerpt' => 'required',
            'content' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news-images', 'public');
        }

        News::create($validated);

        return back()->with('success', 'Berita berhasil diterbitkan!');
    }
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return back()->with('success', 'Berita berhasil dihapus!');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('berita_edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:news,slug,' . $id,
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'excerpt' => 'required',
            'content' => 'required',
            'author' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news-images', 'public');
        }

        $validated['author'] = $request->author ?? 'Admin';

        $news->update($validated);

        return redirect('/berita_tambah')->with('success', 'Berita berhasil diperbarui!');
    }
}
