<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveStream;
use App\Models\LiveAttendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LiveAttendanceController extends Controller
{
    /**
     * Display the studio data: stream details, attendees, and metrics.
     */
    public function getStudioData(Request $request)
    {
        // 1. Get the latest stream
        $stream = LiveStream::latest()->first();

        if (!$stream) {
            return response()->json([
                'message' => 'No stream record found.',
                'attendees' => ['data' => [], 'last_page' => 1],
                'metrics' => ['total_attendees' => 0, 'unique_users' => 0]
            ], 200);
        }

        // 2. Build the query for attendees
        $query = LiveAttendance::where('live_stream_id', $stream->id);

        // 3. Handle live search filtering
        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        // 4. Fetch with PAGINATION (to satisfy Alpine.js frontend)
        $paginatedAttendees = $query->orderBy('created_at', 'desc')->paginate(10);

        // 5. Transform the data for the UI
        $formattedData = collect($paginatedAttendees->items())->map(fn($item) => [
            'id' => $item->id,
            'name' => $item->name,
            'phone' => $item->phone ?? 'N/A',
            'status' => strtolower($item->status ?? 'online'), // Ensure lowercase for CSS class matching
            'attended_at' => $item->created_at ? $item->created_at->diffForHumans() : 'Just now',
            'full_date' => $item->created_at ? $item->created_at->format('M d, Y H:i') : ''
        ]);

        // 6. Optimized Metrics
        $uniqueUsersCount = LiveAttendance::where('live_stream_id', $stream->id)
            ->whereNotNull('user_id')
            ->distinct('user_id')
            ->count();

        return response()->json([
            'id' => $stream->id,
            'title' => $stream->title,
            'scheduled_date' => $stream->scheduled_date,
            'scheduled_time' => $stream->scheduled_time,
            'stream_link' => $stream->stream_link,
            'is_live' => (bool)$stream->is_live,
            'metrics' => [
                'total_attendees' => $paginatedAttendees->total(),
                'unique_users' => $uniqueUsersCount,
            ],
            // This nested structure matches: data.attendees.data
            'attendees' => [
                'data' => $formattedData,
                'last_page' => $paginatedAttendees->lastPage(),
                'current_page' => $paginatedAttendees->currentPage(),
                'total' => $paginatedAttendees->total(),
            ],
            'comments' => $stream->comments ?? []
        ]);
    }

    /**
     * Update broadcast scheduling details.
     */
    public function updateBroadcast(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required',
            'stream_link' => 'required|url',
        ]);

        $stream = LiveStream::updateOrCreate(
            ['id' => $request->id ?? (LiveStream::latest()->first()->id ?? null)],
            $validated
        );

        return response()->json([
            'message' => 'Broadcast updated successfully',
            'stream' => $stream
        ]);
    }

    /**
     * Toggle Live Status.
     */
    public function toggleLive(Request $request)
    {
        $request->validate(['is_live' => 'required|boolean']);

        $stream = LiveStream::latest()->first();

        if (!$stream) {
            return response()->json(['message' => 'Stream not found'], 404);
        }

        $stream->update(['is_live' => $request->is_live]);

        return response()->json([
            'status' => 'success',
            'is_live' => (bool)$stream->is_live
        ]);
    }

    /**
     * Record a new attendance entry.
     */
    public function storeAttendance(Request $request)
    {
        $stream = LiveStream::latest()->first();

        if (!$stream) {
            return response()->json(['message' => 'No active service found.'], 422);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
        ]);

        $existing = LiveAttendance::where('live_stream_id', $stream->id)
            ->where(function($query) use ($request) {
                $query->where('phone', $request->phone);
                if (Auth::check()) {
                    $query->orWhere('user_id', Auth::id());
                }
            })
            ->where('created_at', '>', now()->subHours(2))
            ->first();

        if ($existing) {
            session(['live_access_granted' => true]);
            return response()->json([
                'message' => 'Welcome back!',
                'attendance' => $existing,
                'redirect' => true
            ]);
        }

        $attendance = LiveAttendance::create([
            'live_stream_id' => $stream->id,
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => 'Online',
            'attended_at' => now(),
        ]);

        session(['live_access_granted' => true]);

        return response()->json([
            'message' => 'Access Granted',
            'attendance' => $attendance
        ]);
    }
}
