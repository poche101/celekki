<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCenter extends Model {
    protected $fillable = ['name', 'address', 'pastor_in_charge', 'phone_number', 'lat', 'lng'];

    public function scopeNear($query, $lat, $lng) {
        return $query->select('*')
            ->selectRaw(
                '(6371 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(lng) - radians(?)) + sin(radians(?)) * sin(radians(lat)))) AS distance',
                [$lat, $lng, $lat]
            )
            ->orderBy('distance');
    }
}
