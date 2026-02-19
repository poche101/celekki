<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the member profile.
     */
    public function edit()
    {
        /** @var \App\Models\User $dbUser */
        $dbUser = Auth::user();

        // If the user doesn't have a member_id yet, generate and save one
        if (!$dbUser->member_id || $dbUser->member_id === 'PENDING') {
            $dbUser->update([
                'member_id' => $this->generateMemberId()
            ]);
        }

        // Transform model data into the array structure expected by the Blade view
        // Mapping migration columns (e.g., church_group) to view keys (e.g., group)
        $user = [
            'title'  => $dbUser->title ?? 'Brother',
            'name'   => $dbUser->name,
            'email'  => $dbUser->email,
            'phone'  => $dbUser->phone ?? 'Not Provided',
            'code'   => $dbUser->member_id,
            'group'  => $dbUser->church_group ?? 'Unassigned',
            'church' => $dbUser->central_church ?? 'Central Church',
            'cell'   => $dbUser->assigned_cell ?? 'Not Assigned',
        ];

        return view('profile', compact('user'));
    }

    /**
     * Update the personal and church affiliation details.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'title'  => 'required|string|max:20',
            'name'   => 'required|string|min:3|max:255',
            'email'  => 'required|email|unique:users,email,' . $user->id,
            'phone'  => 'nullable|string|max:20',
            'group'  => 'nullable|string|max:100',
            'church' => 'nullable|string|max:100',
            'cell'   => 'nullable|string|max:100',
        ]);

        // Manually map the form inputs to the specific database columns in your migration
        $user->update([
            'title'          => $validated['title'],
            'name'           => $validated['name'],
            'email'          => $validated['email'],
            'phone'          => $validated['phone'],
            'church_group'   => $validated['group'],
            'central_church' => $validated['church'],
            'assigned_cell'  => $validated['cell'],
        ]);

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');

    }

    /**
     * Handle the profile photo upload and storage.
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($request->hasFile('photo')) {
            // Check for existing photo using migration column name
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $path = $request->file('photo')->store('profile-photos', 'public');

            // Update the correct column name: profile_photo_path
            $user->update(['profile_photo_path' => $path]);
        }

        return back()->with('success', 'Profile photo updated!');
    }

    /**
     * Toggle the Push Notification preference.
     */
   public function toggleNotifications(Request $request)
{
    $user = auth()->user();

    // Failsafe: if for some reason user is null
    if (!$user) return back();

    // Toggle the boolean value
    $user->notifications_enabled = !$user->notifications_enabled;
    $user->save();

    return back()->with('success', 'Notification settings updated!');
}

    /**
     * Delete the account and invalidate the session.
     */
    public function destroy(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Clean up storage using correct column name
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Account deactivated.');
    }

    /**
     * Generates a unique member ID
     */
    private function generateMemberId(): string
    {
        $prefix = 'CELZ5';
        $numbers = rand(1000, 9999);
        $suffix = strtoupper(Str::random(1));

        return "{$prefix}-{$numbers}-{$suffix}";
    }
}
