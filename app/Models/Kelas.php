<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    protected $fillable = ['nama', 'jurusan_id', 'tingkat', 'rombel', 'tahun_ajaran_id'];

    protected static function booted(): void
    {
        static::saving(function (Kelas $kelas) {
            if (!$kelas->nama && $kelas->jurusan_id && $kelas->tingkat && $kelas->rombel) {
                $kelas->nama = self::generateNama(
                    (int) $kelas->jurusan_id,
                    (int) $kelas->tingkat,
                    (string) $kelas->rombel
                );
            }
        });
    }

    public static function tingkatRomawi(int $tingkat): string
    {
        return match ($tingkat) {
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
            default => (string) $tingkat,
        };
    }

    public static function generateNama(int $jurusanId, int $tingkat, string $rombel): string
    {
        $jurusan = Jurusan::find($jurusanId);
        $kode = $jurusan ? strtoupper($jurusan->kode) : 'KELAS';

        return self::tingkatRomawi($tingkat) . ' ' . $kode . ' ' . $rombel;
    }

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function guruMapel(): HasMany
    {
        return $this->hasMany(GuruMapel::class);
    }

    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }

    public function getLabelAttribute(): string
    {
        if ($this->jurusan_id && $this->tingkat) {
            $rombel = $this->rombel ? ' ' . $this->rombel : '';

            return self::tingkatRomawi((int) $this->tingkat)
                . ' '
                . strtoupper($this->jurusan?->kode ?? '')
                . $rombel;
        }

        return $this->nama ?? '';
    }
}
