<?php

namespace App\Http\Controllers;

use App\Models\Prayer; // Changed to match your migration 'prayers' table
use Illuminate\Http\Request;

class PrayerController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate the input including the dynamic slug
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'request'      => 'required|string|min:10',
            'episode_slug' => 'required|string', // Added this
        ]);

        try {
            // 2. Create the record
            Prayer::create([
                'name'         => $validated['name'],
                'request'      => $validated['request'],
                'episode_slug' => $validated['episode_slug'],
            ]);

            return response()->json([
                'status'  => 'success',
                'message' => 'Your prayer request has been sent to Pastor Deola Phillips.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }
}
