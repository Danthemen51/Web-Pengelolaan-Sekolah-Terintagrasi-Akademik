<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    protected $table = 'ekstrakurikulers';

    protected $fillable = ['name', 'image', 'description', 'schedule', 'coach'];

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        $image = str_replace('\\', '/', $this->image);

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        if (str_starts_with($image, 'storage/')) {
            return asset($image);
        }

        if (str_starts_with($image, 'foto_ekskul/')) {
            return asset($image);
        }

        if (file_exists(public_path('foto_ekskul/' . $image))) {
            return asset('foto_ekskul/' . $image);
        }

        if (file_exists(public_path('storage/' . $image))) {
            return asset('storage/' . $image);
        }

        return asset('foto_ekskul/' . $image);
    }
}