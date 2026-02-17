<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HLife;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HLifeController extends Controller {

    public function index() {
        // We use latest() to show new uploads first
        return response()->json([
            'data' => HLife::latest()->get()
        ]);
    }

    public function store(Request $request) {
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'episode' => 'required|numeric',
                'video_path' => 'required|url',
                'poster_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
            ]);

            if ($request->hasFile('poster_path')) {
                $path = $request->file('poster_path')->store('posters', 'public');
                $data['poster_path'] = $path;
            }

            $video = HLife::create($data);

            return response()->json([
                'message' => 'Video archived successfully',
                'data' => $video
            ], 201);

        } catch (\Exception $e) {
            Log::error("HLife Store Error: " . $e->getMessage());
            return response()->json(['message' => 'Failed to save video: ' . $e->getMessage()], 422);
        }
    }

    public function update(Request $request, $id) {
        try {
            $video = HLife::findOrFail($id);

            // Laravel PUT requests with FormData can be tricky,
            // ensure you are using the _method: PUT trick in your JS.
            $data = $request->validate([
                'title' => 'sometimes|string|max:255',
                'episode' => 'sometimes|numeric',
                'video_path' => 'sometimes|url',
                'poster_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
            ]);

            if ($request->hasFile('poster_path')) {
                // Delete old poster if it exists and isn't a default
                if ($video->poster_path && Storage::disk('public')->exists($video->poster_path)) {
                    Storage::disk('public')->delete($video->poster_path);
                }
                $data['poster_path'] = $request->file('poster_path')->store('posters', 'public');
            }

            $video->update($data);

            return response()->json([
                'message' => 'Archive entry updated',
                'data' => $video
            ]);

        } catch (\Exception $e) {
            Log::error("HLife Update Error: " . $e->getMessage());
            return response()->json(['message' => 'Update failed: ' . $e->getMessage()], 422);
        }
    }

    public function destroy($id) {
        try {
            $video = HLife::findOrFail($id);

            if ($video->poster_path && Storage::disk('public')->exists($video->poster_path)) {
                Storage::disk('public')->delete($video->poster_path);
            }

            $video->delete();
            return response()->json(['message' => 'Deleted successfully from archive']);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Delete failed'], 500);
        }
    }
}
