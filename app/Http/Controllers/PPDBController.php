<?php

namespace App\Http\Controllers;

use App\Models\PPDBWave;
use Illuminate\Http\Request;

class PPDBController extends Controller
{
    /**
     * Display PPDB page with active wave info
     */
    public function show()
    {
        // Prefer a wave that is currently open. If none, fall back to any wave
        // that has been flagged active by admin (so admin can preview or manage it).
        $activeWave = PPDBWave::aktif()->first();

        if (! $activeWave) {
            $activeWave = PPDBWave::where('is_active', true)
                ->orderBy('tanggal_mulai')
                ->first();
        }

        // Upcoming waves: exclude the chosen activeWave (if it's a future preview)
        $upcomingQuery = PPDBWave::where('tanggal_mulai', '>', now());
        if ($activeWave) {
            $upcomingQuery->where('id', '!=', $activeWave->id);
        }
        $upcomingWaves = $upcomingQuery->orderBy('tanggal_mulai')->get();

        // Past waves: exclude the chosen activeWave when appropriate
        $pastQuery = PPDBWave::where('tanggal_selesai', '<', now())
            ->orderBy('tanggal_selesai', 'desc')
            ->limit(3);
        if ($activeWave) {
            $pastQuery->where('id', '!=', $activeWave->id);
        }
        $pastWaves = $pastQuery->get();

        return view('ppdb', compact('activeWave', 'upcomingWaves', 'pastWaves'));
    }
}
