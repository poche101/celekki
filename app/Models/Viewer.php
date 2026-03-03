<?php

// Run: php artisan make:model Viewer

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viewer extends Model
{
    protected $fillable = ['name', 'phone', 'location'];
}
