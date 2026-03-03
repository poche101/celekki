<?php

namespace App\Http\Controllers;

use App\Models\PrayerRequest;
use Illuminate\Http\Request;

class PrayerController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate the input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'request' => 'required|string|min:10',
        ]);

        try {
            // 2. Create the record
            PrayerRequest::create($validated);

            // 3. Return JSON for the AJAX toast
            return response()->json([
                'status' => 'success',
                'message' => 'Your prayer request has been sent to Pastor Deola Phillips.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again.'
            ], 500);
        }
    }
}
