<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    // These are the fields we can fill in the database
    protected $fillable = [
        'slug',
        'title',
        'video_url',
        'poster',
        'type',
        'is_active'
    ];
}
