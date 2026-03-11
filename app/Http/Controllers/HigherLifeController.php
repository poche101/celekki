<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Viewer;
use App\Models\Prayer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HigherLifeController extends Controller
{
    /**
     * Show Access Gate (Registration Form)
     */
    public function showGate($id)
    {
        // Ensure ID is numeric to prevent directory traversal or weird slugs
        if (!is_numeric($id)) abort(404);

        $slug = 'ep' . $id;
        return view('higherlife.gate', compact('slug', 'id'));
    }

    /**
     * Handle Gate Form Submission
     */
    public function access(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'phone'        => 'nullable|string|max:20',
            'location'     => 'nullable|string',
            'episode_slug' => 'required|string'
        ]);

        // Log visitor BEFORE session granting for better tracking
        Viewer::create($validated);

        // Grant access in session
        session(['access_granted_' . $validated['episode_slug'] => true]);

        $id = Str::after($validated['episode_slug'], 'ep');

        return response()->json([
            'status' => 'success',
            'redirect_url' => route('higher-life.episode', ['id' => $id])
        ]);
    }

    /**
     * Show Episode Page (Video Player)
     */
   public function showEpisode($id)
{
    $slug = 'ep' . $id;

    // Security Check: Redirect if session doesn't exist
    if (!session()->has('access_granted_' . $slug)) {
        return redirect()->route('higher-life.gate', ['id' => $id]);
    }

    // 1. Fetch from Database
    $episode = Episode::where('slug', $slug)->first();

    if (!$episode) {
        // 2. Fallback Library
        $library = [
            '5'  => ['title' => 'How To Make Your Life What You Want', 'video' => 'https://8v4o6w73awqp-hls-push.5centscdn.com/EPISODE%205%20Repackaged.mp4/playlist.m3u8', 'poster' => 'images/poster5.png'],
            '12' => ['title' => '2 Of Your Creative Powers', 'video' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/Nov9tEd_5a085fe4f916b95c0f2f58e9.mp4', 'poster' => 'images/power.png'],
            '14' => ['title' => 'The Study Of Ephesians', 'video' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/h-life13202_601699fe3ccc7b0007cbc451.mp4', 'poster' => 'images/THE.png'],
            '15' => ['title' => 'The Higher Life', 'video' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/finalep1_61c461d1efb1d00007d781ed.mp4', 'poster' => 'images/ep1.png'],
        ];

        // --- FIX: Sort keys by length descending ---
        // This ensures '15' is checked before '5' when the ID is '10015'
        uksort($library, fn($a, $b) => strlen($b) <=> strlen($a));

        // 3. Match logic
        $matched = null;
        foreach ($library as $key => $details) {
            // Check for exact match or suffix match
            if ($id == $key || \Illuminate\Support\Str::endsWith($id, $key)) {
                $matched = $details;
                break;
            }
        }

        // 4. Default if no match found
        $data = $matched ?? [
            'title' => 'Sunday Service',
            'video' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/today112_601699fe3ccc7b0007cbc451.mp4',
            'poster' => 'images/logo.png'
        ];

        // Create an "on-the-fly" model instance
        $episode = new Episode();
        $episode->fill([
            'slug'      => $slug,
            'title'     => $data['title'],
            'video_url' => $data['video'],
            'poster'    => $data['poster']
        ]);
    }

    return view('higherlife.episode', compact('episode', 'slug', 'id'));
}

    /**
     * Handle Prayer Request Submission
     */
    public function submitPrayer(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'nullable|email',
            'request'      => 'required|string|min:10',
            'episode_slug' => 'required|string',
        ]);

        Prayer::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Your prayer request has been sent to Pastor Deola Phillips.'
        ]);
    }
}
