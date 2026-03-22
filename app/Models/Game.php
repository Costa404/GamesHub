<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'studio_id',
        'name',
        'image',
        'release_date',
        'genre',
        'platform',
        'pegi',
    ];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function reviews()
{
    return $this->hasMany(Review::class);
}

public function averageRating()
{
    return $this->reviews()->avg('rating');
}
}
