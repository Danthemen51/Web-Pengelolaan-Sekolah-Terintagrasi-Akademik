<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PPDBWave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PPDBController extends Controller
{
    /**
     * Display list of PPDB waves
     */
    public function index()
    {
        $waves = PPDBWave::orderBy('tanggal_mulai', 'desc')->get();
        return view('admin.ppdb.index', compact('waves'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.ppdb.create');
    }

    /**
     * Store new PPDB wave
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date_format:Y-m-d\TH:i',
            'tanggal_selesai' => 'required|date_format:Y-m-d\TH:i|after:tanggal_mulai',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('ppdb_posters', 'public');
        }

        PPDBWave::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => Carbon::createFromFormat('Y-m-d\TH:i', $request->tanggal_mulai)->format('Y-m-d H:i:s'),
            'tanggal_selesai' => Carbon::createFromFormat('Y-m-d\TH:i', $request->tanggal_selesai)->format('Y-m-d H:i:s'),
            'poster' => $posterPath,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.ppdb.index')
            ->with('success', 'Gelombang PPDB berhasil ditambahkan!');
    }

    /**
     * Show edit form
     */
    public function edit(PPDBWave $ppdbWave)
    {
        return view('admin.ppdb.edit', compact('ppdbWave'));
    }

    /**
     * Update PPDB wave
     */
    public function update(Request $request, PPDBWave $ppdbWave)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date_format:Y-m-d\TH:i',
            'tanggal_selesai' => 'required|date_format:Y-m-d\TH:i|after:tanggal_mulai',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $posterPath = $ppdbWave->poster;
        if ($request->hasFile('poster')) {
            // Delete old poster
            if ($posterPath && Storage::disk('public')->exists($posterPath)) {
                Storage::disk('public')->delete($posterPath);
            }
            $posterPath = $request->file('poster')->store('ppdb_posters', 'public');
        }

        $ppdbWave->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => Carbon::createFromFormat('Y-m-d\TH:i', $request->tanggal_mulai)->format('Y-m-d H:i:s'),
            'tanggal_selesai' => Carbon::createFromFormat('Y-m-d\TH:i', $request->tanggal_selesai)->format('Y-m-d H:i:s'),
            'poster' => $posterPath,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('admin.ppdb.index')
            ->with('success', 'Gelombang PPDB berhasil diperbarui!');
    }

    /**
     * Delete PPDB wave
     */
    public function destroy(PPDBWave $ppdbWave)
    {
        // Delete poster file
        if ($ppdbWave->poster && Storage::disk('public')->exists($ppdbWave->poster)) {
            Storage::disk('public')->delete($ppdbWave->poster);
        }

        $ppdbWave->delete();

        return back()->with('success', 'Gelombang PPDB berhasil dihapus!');
    }

    /**
     * Activate/Deactivate PPDB wave
     */
    public function toggleActive(PPDBWave $ppdbWave)
    {
        if ($ppdbWave->is_active) {
            $ppdbWave->update(['is_active' => false]);
            $message = 'Gelombang PPDB nonaktifkan.';
        } else {
            // Deactivate other waves
            PPDBWave::where('id', '!=', $ppdbWave->id)->update(['is_active' => false]);
            $ppdbWave->update(['is_active' => true]);
            $message = 'Gelombang PPDB diaktifkan.';
        }

        return back()->with('success', $message);
    }
}
