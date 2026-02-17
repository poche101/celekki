<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HLife extends Model {
    protected $fillable = ['title', 'episode', 'video_path', 'poster_path'];

    // This adds 'poster_url' to the JSON response automatically
    protected $appends = ['poster_url'];

public function getPosterUrlAttribute() {
    return $this->poster_path
        ? asset('storage/' . $this->poster_path)
        : 'https://placehold.co/600x400?text=No+Thumbnail';
}
}
