<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kuisioner extends Model
{
    protected $table = 'kuisioner';

    protected $fillable = [
        'pertanyaan',
        'kategori',
        'is_active',
        'tahun_ajaran_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function jawaban(): HasMany
    {
        return $this->hasMany(Jawaban::class, 'kuisioner_id');
    }

    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }
}
