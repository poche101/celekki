<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'message'   => 'required|string',
        ]);

        Contact::create($validated);

        return back()->with('status', 'Message sent successfully!');
    }
}
