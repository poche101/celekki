<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the premium admin login page.
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Handle the admin authentication attempt.
     */
    public function login(Request $request)
    {
        // 1. Validate the input
        $credentials = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string'],
        ]);

        // 2. Attempt to log the admin in
        // The second argument handles the 'remember' checkbox
        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // 3. Prevent Session Fixation attacks
            $request->session()->regenerate();

            // 4. Redirect to the intended dashboard or a default route
            return redirect()->intended(route('admin.dashboard'))
                ->with('status', 'Welcome back, Man of God.');
        }

        // 5. If login fails, throw an exception that Laravel handles
        // This will trigger the @error('email') in your design
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    /**
     * Destroy the admin session.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
