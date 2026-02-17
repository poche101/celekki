<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * GET /admin/api/events
     * Fetch all events sorted by date
     */
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->get()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'date' => $event->date->format('Y-m-d'),
                'time' => $event->time,
                'location' => $event->location,
                'isLive' => (bool) $event->is_live,
                'image' => $event->image ? asset('storage/' . $event->image) : null,
            ];
        });

        return response()->json($events);
    }

    /**
     * POST /admin/api/events
     * Create a new event
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|string',
            'location' => 'required|string',
            'isLive' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        $event = Event::create([
            'title' => $validated['title'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'location' => $validated['location'],
            'is_live' => filter_var($request->isLive, FILTER_VALIDATE_BOOLEAN),
            'image' => $imagePath,
        ]);

        return response()->json(['message' => 'Event created successfully', 'event' => $event]);
    }

    /**
     * POST (with _method=PUT) /admin/api/events/{id}
     * Update existing event
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|string',
            'location' => 'required|string',
            'isLive' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->update([
            'title' => $validated['title'],
            'date' => $validated['date'],
            'time' => $validated['time'],
            'location' => $validated['location'],
            'is_live' => filter_var($request->isLive, FILTER_VALIDATE_BOOLEAN),
        ]);

        return response()->json(['message' => 'Event updated successfully']);
    }

    /**
     * DELETE /admin/api/events/{id}
     */
    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }
}
