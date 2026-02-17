<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
 public function store(Request $request, Event $event)
{
    $validated = $request->validate([
        'name'   => 'required|string|max:255',
        'email'  => 'required|email|max:255',
        'phone'  => 'required|string|max:20', // Added validation
        'church' => 'required|string|max:255',
        'group'  => 'required|string|max:255',
    ]);

    EventRegistration::create([
        'event_id'  => $event->id,
        'full_name' => $validated['name'],
        'email'     => $validated['email'],
        'phone'     => $validated['phone'], // Save it here
        'church'    => $validated['church'],
        'group'     => $validated['group'],
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Registration Complete!');
}
}
