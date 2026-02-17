<?php

namespace App\Http\Controllers;

use App\Models\LiveStream;
use App\Models\LiveAttendance; // Added this
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon; // Added this

class LiveStreamController extends Controller
{
    /**
     * Display the live stream view for members.
     */
    public function index()
    {
        $stream = \App\Models\LiveStream::firstOrCreate(
            ['id' => 1],
            [
                'title' => 'The Power of Persistent Prayer',
                'is_live' => false,
                'scheduled_date' => now(),
                'scheduled_time' => '09:00',
                'stream_link' => 'https://www.youtube.com/watch?v=uD9-jNKwSa0'
            ]
        );

        return view('live-stream', compact('stream'));
    }

    /**
     * API: Get the current stream details and attendance for the admin studio.
     */
    public function getStudioData(Request $request)
{
    $stream = LiveStream::latest()->first();

    if (!$stream) {
        return response()->json([
            'message' => 'No stream record found.',
            'attendees' => ['data' => [], 'last_page' => 1],
            'metrics' => ['total_attendees' => 0, 'unique_users' => 0]
        ], 200);
    }

    $query = LiveAttendance::where('live_stream_id', $stream->id);

    if ($request->filled('search')) {
        $search = $request->query('search');
        $query->where(function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('phone', 'LIKE', "%{$search}%");
        });
    }

    // UPDATE: Changed ->get() to ->paginate(10)
    // This provides the 'last_page' and 'current_page' info Alpine needs
    $paginatedAttendees = $query->orderBy('created_at', 'desc')->paginate(10);

    // We transform the data inside the paginator
    $paginatedAttendees->getCollection()->transform(fn($item) => [
        'id' => $item->id,
        'name' => $item->name,
        'phone' => $item->phone ?? 'N/A',
        'status' => $item->status,
        'attended_at' => Carbon::parse($item->created_at)->diffForHumans(),
        'full_date' => Carbon::parse($item->created_at)->format('M d, Y H:i')
    ]);

    $uniqueUsersCount = LiveAttendance::where('live_stream_id', $stream->id)
        ->whereNotNull('user_id')
        ->distinct('user_id')
        ->count();

    return response()->json([
        'id' => $stream->id,
        'title' => $stream->title,
        'is_live' => (bool)$stream->is_live,
        'metrics' => [
            'total_attendees' => $paginatedAttendees->total(), // Total count across all pages
            'unique_users' => $uniqueUsersCount,
        ],
        'attendees' => $paginatedAttendees, // This now contains 'data', 'last_page', etc.
        'comments' => $stream->comments ?? []
    ]);
}
    /**
     * Update title, date, time, and link.
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'scheduled_date' => 'nullable|date',
            'scheduled_time' => 'nullable',
            'stream_link' => 'nullable|url',
        ]);

        $stream = LiveStream::first();
        $stream->update($request->only(['title', 'scheduled_date', 'scheduled_time', 'stream_link']));

        return response()->json([
            'message' => 'Broadcast details updated successfully!',
            'stream' => $stream
        ]);
    }

    /**
     * Toggle the Live Status (The Red Switch).
     */
    public function toggleLive(Request $request)
    {
        $stream = LiveStream::first();
        $stream->is_live = $request->is_live;
        $stream->save();

        $status = $stream->is_live ? 'Live' : 'Offline';
        return response()->json([
            'message' => "Studio is now $status",
            'is_live' => $stream->is_live
        ]);
    }
}
