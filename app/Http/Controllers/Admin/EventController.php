<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * This matches: Route::get('/events', [AdminEventController::class, 'apiIndex'])
     */
    public function apiIndex()
    {
        $events = Event::orderBy('date', 'desc')->get()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'date' => $event->date,
                'time' => $event->time,
                'location' => $event->location,
                'isLive' => (bool) $event->is_live,
                'image' => $event->image ? asset('storage/' . $event->image) : null,
            ];
        });

        return response()->json($events);
    }

    /**
     * This matches: Route::post('/events', [AdminEventController::class, 'apiSave'])
     */
    public function apiSave(Request $request, $id = null)
    {
        // If $id is provided, find the event; otherwise, create a new one
        $event = $id ? Event::findOrFail($id) : new Event();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'nullable|string',
            'location' => 'nullable|string',
            'isLive' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->title = $validated['title'];
        $event->date = $validated['date'];
        $event->time = $validated['time'];
        $event->location = $validated['location'];
        $event->is_live = filter_var($request->isLive, FILTER_VALIDATE_BOOLEAN);
        $event->save();

        return response()->json(['message' => 'Event saved successfully', 'event' => $event]);
    }

    /**
     * This matches: Route::delete('/events/{id}', [AdminEventController::class, 'apiDestroy'])
     */
    public function apiDestroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();
        return response()->json(['message' => 'Event deleted']);
    }

    /**
     * This matches: Route::get('/events-page', [AdminEventController::class, 'index'])
     */
    public function index()
    {
        return view('admin.tabs.events'); // Ensure this view exists!
    }
}
