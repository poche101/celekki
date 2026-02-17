<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LiveStream extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'scheduled_date',
        'scheduled_time',
        'stream_link',
        'is_live',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_live' => 'boolean',
        'scheduled_date' => 'date',
        // Optional: Cast time if you want to use Carbon for time manipulation
        // 'scheduled_time' => 'datetime:H:i',
    ];

    /**
     * Get the user (admin/host) that owns the live stream.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
