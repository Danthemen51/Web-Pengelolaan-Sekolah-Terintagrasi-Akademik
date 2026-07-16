<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PPDBWave extends Model
{
    protected $table = 'ppdb_waves';

    protected $fillable = [
        'nama',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'is_active',
        'poster',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Scope: Get active PPDB wave
     */
    public function scopeAktif($query)
    {
        return $query->where('is_active', true)
            ->where('tanggal_mulai', '<=', now())
            ->where('tanggal_selesai', '>=', now());
    }

    /**
     * Scope: Get upcoming waves
     */
    public function scopeUpcoming($query)
    {
        return $query->where('tanggal_mulai', '>', now())
            ->orderBy('tanggal_mulai');
    }

    /**
     * Check if wave is currently open
     */
    public function isOpen(): bool
    {
        return $this->is_active
            && now()->between($this->tanggal_mulai, $this->tanggal_selesai);
    }

    /**
     * Format tanggal untuk display
     */
    public function getFormatTanggalAttribute(): string
    {
        $mulai = $this->tanggal_mulai->translatedFormat('d F Y H:i');
        $selesai = $this->tanggal_selesai->translatedFormat('d F Y H:i');
        return "$mulai - $selesai";
    }
}
