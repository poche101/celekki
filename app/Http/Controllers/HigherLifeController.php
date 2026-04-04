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
    // 1. Scrub the ID: Remove 'ep' and any non-numeric junk
    $numericId = preg_replace('/[^0-9]/', '', $id);
    $slug = 'ep' . $numericId;

    // 2. Security Check: Redirect if session doesn't exist
    if (!session()->has('access_granted_' . $slug)) {
        return redirect()->route('higher-life.gate', ['id' => $numericId]);
    }

    // 3. Fetch from Database
    $episode = Episode::where('slug', $slug)->first();

    if (!$episode) {
        // 4. Fallback Library
        $library = [
             '18' => ['title' => 'Discover How To Realign With Gods Plan For Your Life', 'video' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/THLEpd2u_61c461d1efb1d00007d781ed.mp4', 'poster' => 'images/sons3.png'],
            '17' => ['title' => 'The Sons Of God (part 3)', 'video' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/EP16_5a085fe4f916b95c0f2f58e9.mp4', 'poster' => 'images/sons3.png'],
            '16' => ['title' => 'The Sons Of God (part 3)', 'video' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/hlife014_601699fe3ccc7b0007cbc451.mp4', 'poster' => 'images/sons3.png'],
            '15' => ['title' => 'The Higher Life', 'video' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/finalep1_61c461d1efb1d00007d781ed.mp4', 'poster' => 'images/ep1.png'],
            '14' => ['title' => 'The Study Of Ephesians', 'video' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/h-life13202_601699fe3ccc7b0007cbc451.mp4', 'poster' => 'images/THE.png'],
            '13' => ['title' => 'Global Fasting And Prayer With Pastor Chris', 'video' => 'https://vcpout-sf01-altnetro.internetmultimediaonline.org/ext/ext1.smil/playlist.m3u8', 'poster' => 'images/logo.png'],
            '12' => ['title' => '2 Of Your Creative Powers', 'video' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/Nov9tEd_5a085fe4f916b95c0f2f58e9.mp4', 'poster' => 'images/power.png'],
            '6'  => ['title' => 'How To Make Your Life What You Want', 'video' => 'https://8v4o6w73awqp-hls-push.5centscdn.com/EPISODE%205%20Repackaged.mp4/playlist.m3u8', 'poster' => 'images/poster5.png'],
            '5'  => ['title' => 'How To Make Your Life What You Want', 'video' => 'https://8v4o6w73awqp-hls-push.5centscdn.com/EPISODE%205%20Repackaged.mp4/playlist.m3u8', 'poster' => 'images/poster5.png'],
        ];

        // Ensure keys are checked by length (Longest first)
        uksort($library, fn($a, $b) => strlen((string)$b) <=> strlen((string)$a));

        $matched = null;
        $searchStr = (string)$numericId;

        foreach ($library as $key => $details) {
            $keyStr = (string)$key;

            // Strict suffix check: Does "10016" end with "16"?
            if ($searchStr === $keyStr || \Illuminate\Support\Str::endsWith($searchStr, $keyStr)) {
                $matched = $details;
                break;
            }
        }

        $data = $matched ?? [
            'title' => 'Sunday Service',
            'video' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/today112_601699fe3ccc7b0007cbc451.mp4',
            'poster' => 'images/logo.png'
        ];

        $episode = new Episode();
        $episode->fill([
            'slug'      => $slug,
            'title'     => $data['title'],
            'video_url' => $data['video'],
            'poster'    => $data['poster']
        ]);
    }

    // Pass 'numericId' instead of 'id' to the view to keep things clean
    return view('higherlife.episode', [
        'episode' => $episode,
        'slug' => $slug,
        'id' => $numericId
    ]);
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
