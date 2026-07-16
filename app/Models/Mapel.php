<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mapel extends Model
{
    protected $fillable = ['nama', 'jurusan_id', 'tingkat'];

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function guruMapel(): HasMany
    {
        return $this->hasMany(GuruMapel::class);
    }

    public function getKonteksAttribute(): string
    {
        $tingkat = $this->tingkat ? Kelas::tingkatRomawi((int) $this->tingkat) : '?';
        $jurusan = $this->jurusan ? strtoupper($this->jurusan->kode) : '?';

        return "{$tingkat} {$jurusan}";
    }
}
