<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EnsureLiveAccess
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the session variable 'live_access_granted' exists
        if (!Session::has('live_access_granted')) {
            // Redirect them back to where they came from with a trigger to open the modal
            // or redirect to a specific check-in page.
            return redirect('/')->with('show_live_modal', true);
        }

        return $next($request);
    }
}