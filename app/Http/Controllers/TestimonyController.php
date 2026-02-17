<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class TestimonyController extends Controller
{
    /**
     * Public View for Testimonies (with Search and Pagination)
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Build query with optional search
        $query = Testimony::where('is_approved', true)
            ->when($search, function ($q) use ($search) {
                $q->where(function($inner) use ($search) {
                    $inner->where('name', 'like', "%{$search}%")
                          ->orWhere('group', 'like', "%{$search}%")
                          ->orWhere('content', 'like', "%{$search}%");
                });
            });

        // Paginate results (12 per page)
        $testimonies = $query->latest()->paginate(12)->withQueryString();

        // Separate collections for Alpine.js frontend logic
        $videoTestimonies = $testimonies->getCollection()->whereNotNull('video_url')->where('video_url', '!=', '')->values();
        $textTestimonies = $testimonies->getCollection()->where(fn($item) => empty($item->video_url))->values();

        return view('testimonies.index', compact('testimonies', 'videoTestimonies', 'textTestimonies', 'search'));
    }

    /**
     * Admin Dashboard View (with Search and Stats)
     */
    public function adminIndex(Request $request)
    {
        $search = $request->input('search');

        $query = Testimony::query()
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('group', 'like', "%{$search}%");
            });

        $testimonies = $query->latest()->paginate(10)->withQueryString();

        $stats = [
            'total' => Testimony::count(),
            'pending' => Testimony::where('is_approved', false)->count(),
            'video' => Testimony::whereNotNull('video_url')->where('video_url', '!=', '')->count(),
        ];

        return view('admin.tabs.testimonies', compact('testimonies', 'stats', 'search'));
    }

    /**
     * Export Testimonies to CSV
     */
    public function exportCsv()
    {
        $fileName = 'testimonies_export_' . now()->format('Y-m-d_His') . '.csv';
        $testimonies = Testimony::cursor();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use($testimonies) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, ['ID', 'Name', 'Group', 'Content', 'Video URL', 'Status', 'Date Submitted']);

            foreach ($testimonies as $t) {
                fputcsv($file, [
                    $t->id,
                    $t->name,
                    $t->group,
                    $t->content,
                    $t->video_url ?? 'None',
                    $t->is_approved ? 'Approved' : 'Pending',
                    $t->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Fast Approval Toggle
     */
    public function toggleApproval(Testimony $testimony)
    {
        $testimony->update([
            'is_approved' => !$testimony->is_approved
        ]);

        return back()->with('success', 'Status updated successfully!');
    }

    /**
     * Permanent Delete
     */
    public function destroy(Testimony $testimony)
    {
        $testimony->delete();
        return back()->with('success', 'Testimony deleted permanently.');
    }

    /**
     * Store new testimony (Submission)
     * UPDATED: Returns JSON to support AJAX/Fetch calls from the frontend
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'group' => 'nullable|string|max:255',
                'content' => 'required|string',
                'video_url' => 'nullable|url',
            ]);

            // Default to approved for immediate visibility, or false for moderation
            $validated['is_approved'] = true;

            $testimony = Testimony::create($validated);

            // Check if request expects JSON (like your Alpine.js fetch call)
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Your testimony has been submitted!',
                    'data' => $testimony
                ], 201);
            }

            return back()->with('success', 'Your testimony has been submitted!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        }
    }
}
