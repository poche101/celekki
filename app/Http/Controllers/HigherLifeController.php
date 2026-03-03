<?php

namespace App\Http\Controllers;

use App\Models\Viewer;
use Illuminate\Http\Request;

class HigherLifeController extends Controller
{
    /**
     * Show the elegant gateway form.
     */
    public function showGate($slug)
    {
        return view('higherlife.gate', compact('slug'));
    }

    /**
     * Handle the form submission and save viewer data.
     */
    public function access(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'phone'        => 'nullable|string|max:20',
            'location'     => 'nullable|string|in:Mainland,Island',
            'episode_slug' => 'required|string'
        ]);

        Viewer::create([
            'name'     => $validated['name'],
            'phone'    => $validated['phone'],
            'location' => $validated['location'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Access granted',
            'redirect_url' => route('higher-life.episode', $validated['episode_slug'])
        ]);
    }

    /**
     * Show the dynamic episode page using ONE blade file.
     */
    public function showEpisode($slug)
    {
        $videoData = [
            'episode-5' => [
                'title' => 'How To Make Your Life What You Want',
                'video_url' => 'https://8v4o6w73awqp-hls-push.5centscdn.com/EPISODE%205%20Repackaged.mp4/playlist.m3u8',
                'poster' => '/images/how.png',
                'number' => '5',
                'type' => 'hls' // Uses HLS.js
            ],
            'episode-12' => [
                'title' => '2 Of Your Creative Power',
                'video_url' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/Nov9tEd_5a085fe4f916b95c0f2f58e9.mp4',
                'poster' => '/images/power.png',
                'number' => '12',
                'type' => 'mp4' // Standard video playback
            ],
             'episode-8' => [
                'title' => 'The Study Of Ephesians',
                'video_url' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/h-life13202_601699fe3ccc7b0007cbc451.mp4',
                'poster' => '/images/THE.png',
                'number' => '8',
                'type' => 'mp4' // Standard video playback
            ],
        ];

        // 1. Check if the requested slug exists in our data
        if (!array_key_exists($slug, $videoData)) {
            // If not found, redirect to the access gate for episode-5 as a fallback
            return redirect()->route('higher-life.gate', ['slug' => 'episode-5']);
        }

        // 2. Get the specific episode data
        $episode = $videoData[$slug];

        // 3. Return the SAME view for every episode
        return view('higherlife.episode', compact('episode', 'slug'));
    }
}
