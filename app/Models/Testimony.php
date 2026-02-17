<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'group',
        'content',
        'video_url',
        'is_featured',
        'is_approved'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Scope to only show approved stories for the public site.
     * Usage: Testimony::approved()->get();
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Helper to determine if the testimony has a video.
     */
    public function hasVideo()
    {
        return !empty($this->video_url);
    }
}
