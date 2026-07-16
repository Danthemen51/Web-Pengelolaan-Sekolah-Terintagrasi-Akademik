<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';

    protected $fillable = ['nama', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function aktif(): ?self
    {
        return static::query()->where('is_active', true)->first()
            ?? static::query()->orderByDesc('id')->first();
    }
}
