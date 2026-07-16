<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $fillable = [
        'user_id',
        'nama',
        'nuptk',
        'jabatan',
        'status',
        'tahun_mulai',
        'foto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'guru_id', 'user_id');
    }

    public function getNamaLengkapAttribute(): string
    {
        return $this->user?->name ?? $this->nama ?? 'Guru';
    }
}
