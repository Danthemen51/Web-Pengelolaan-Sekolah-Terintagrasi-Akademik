<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    public function create()
    {
        $pengumuman = Pengumuman::with('user')->latest()->get();

        return view('admin.pengumuman.create', compact('pengumuman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'target' => 'required|in:semua,guru,siswa',
            'expired_at' => 'nullable|date|after_or_equal:today',
        ]);

        Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'target' => $request->target,
            'user_id' => Auth::id(),
            'expired_at' => $request->expired_at,
        ]);

        return back()->with('success', 'Pengumuman berhasil dibuat!');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'target' => 'required|in:semua,guru,siswa',
            'expired_at' => 'nullable|date',
        ]);

        $pengumuman->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'target' => $request->target,
            'expired_at' => $request->expired_at ?: null,
        ]);

        return redirect()->route('admin.pengumuman.create')->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return back()->with('success', 'Pengumuman berhasil dihapus!');
    }
}
