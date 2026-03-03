<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrayerRequest extends Model
{
    // Mass assignment protection
    protected $fillable = ['name', 'request', 'is_reviewed'];
}
