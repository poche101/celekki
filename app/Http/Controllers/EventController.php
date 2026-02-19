<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    /**
     * Renders the main public events grid page
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
     * PUBLIC API: Returns JSON for guest-facing views
     * This is what your Alpine.js "fetch('/api/public-events')" calls
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
                        'date'        => $event->date ? $event->date->format('M d, Y') : 'TBA',
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
