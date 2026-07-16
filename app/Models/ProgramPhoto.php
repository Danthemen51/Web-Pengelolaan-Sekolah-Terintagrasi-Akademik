<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramPhoto extends Model
{
    protected $fillable = ['jurusan', 'caption', 'foto'];

    public function scopeJurusan($query, $jurus)
    {
        return $query->where('jurusan', $jurus);
    }
}