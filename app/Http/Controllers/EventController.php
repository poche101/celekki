<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Renders the main events grid page (The Blade Skeleton)
     */
    public function index()
    {
        return view('events.index');
    }

    /**
     * Renders the single event detail page
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    /**
     * ADMIN API: Get all events for the manager
     * URL: GET /admin/api/events
     */
    public function apiIndex()
    {
        $events = Event::orderBy('id', 'desc')->get()->map(function ($event) {
            return [
                'id'       => $event->id,
                'title'    => $event->title,
                'date'     => $event->date ? $event->date->format('Y-m-d') : '',
                'time'     => $event->time,
                'location' => $event->location,
                'image'    => $event->image ? asset('storage/' . $event->image) : null,
                'isLive'   => (bool)$event->is_live,
            ];
        });

        return response()->json($events);
    }

    /**
     * ADMIN API: Store or Update event
     * URL: POST /admin/api/events (New)
     * URL: POST /admin/api/events/{id} (Update with _method=PUT)
     */
    public function apiSave(Request $request, $id = null)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date'  => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            $event = $id ? Event::findOrFail($id) : new Event();

            $event->title    = $request->title;
            $event->date     = $request->date;
            $event->time     = $request->time;
            $event->location = $request->location;
            $event->is_live  = $request->isLive == '1' || $request->isLive == 'true';
            $event->is_published = true; // Defaulting to published for admin creates

            if ($request->hasFile('image')) {
                // Delete old image if updating
                if ($event->image) {
                    Storage::disk('public')->delete($event->image);
                }
                $event->image = $request->file('image')->store('events', 'public');
            }

            $event->save();

            return response()->json(['success' => true, 'event' => $event]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * ADMIN API: Delete event
     * URL: DELETE /admin/api/events/{id}
     */
    public function apiDestroy($id)
    {
        try {
            $event = Event::findOrFail($id);
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $event->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Delete failed'], 500);
        }
    }

    /**
     * PUBLIC API: Returns JSON for guest-facing views
     */
    public function getPublicData()
    {
        try {
            $events = Event::where('is_published', true)
                ->orderBy('date', 'asc')
                ->get()
                ->map(function ($event) {
                    return [
                        'id'          => $event->id,
                        'title'       => $event->title,
                        'description' => $event->description,
                        'date'        => $event->date->format('M d, Y'),
                        'time'        => $event->time,
                        'location'    => $event->location,
                        'image'       => $event->image ? asset('storage/' . $event->image) : null,
                        'isLive'      => (bool)$event->is_live,
                        'category'    => $event->category,
                    ];
                });

            return response()->json($events);
        } catch (\Exception $e) {
            Log::error("Events API Error: " . $e->getMessage());
            return response()->json(['error' => 'Could not load events.'], 500);
        }
    }
}
