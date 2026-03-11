<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Viewer;
use App\Models\Prayer;
use Illuminate\Http\Request;

class HigherLifeController extends Controller
{
    /**
     * Show Access Gate (Registration Form)
     */
    public function showGate($id)
    {
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

        // Grant access in session
        session(['access_granted_' . $validated['episode_slug'] => true]);

        // Log visitor
        Viewer::create($validated);

        $id = str_replace('ep', '', $validated['episode_slug']);

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

        // Security Check
        if (!session()->has('access_granted_' . $slug)) {
            return redirect()->route('higher-life.gate', ['id' => $id]);
        }

        // 1. Try to find in Database first
        $episode = Episode::where('slug', $slug)->first();

        if (!$episode) {
            // 2. Fallback Library
            $library = [
                '5' => [
                    'title' => 'How To Make Your Life What You Want',
                    'video' => 'https://8v4o6w73awqp-hls-push.5centscdn.com/EPISODE%205%20Repackaged.mp4/playlist.m3u8',
                    'poster'=> 'images/poster5.png'
                ],
                '12' => [
                    'title' => '2 Of Your Creative Powers',
                    'video' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/Nov9tEd_5a085fe4f916b95c0f2f58e9.mp4',
                    'poster'=> 'images/power.png'
                ],
                '14' => [
                    'title' => 'The Study Of Ephesians',
                    'video' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/h-life13202_601699fe3ccc7b0007cbc451.mp4',
                    'poster'=> 'images/THE.png'
                ],
            ];

            // 3. FLEXIBLE SEARCH: Check if the ID matches or ends with a library key
            $matchedData = null;
            foreach ($library as $key => $details) {
                // This matches if $id is '12', '1012', or '10012'
                if ($id == $key || str_ends_with($id, $key)) {
                    $matchedData = $details;
                    break;
                }
            }

            // 4. Apply matched data or use default
            $data = $matchedData ?? [
                'title' => 'Sunday Service',
                'video' => 'https://s3.eu-west-2.amazonaws.com/lodams-videoshare/videos/today112_601699fe3ccc7b0007cbc451.mp4"',
                'poster'=> 'images/logo.png'
            ];

            $episode = new Episode();
            $episode->slug = $slug;
            $episode->title = $data['title'];
            $episode->video_url = $data['video'];
            $episode->poster = $data['poster'];
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
            'status' => 'success',
            'message' => 'Your prayer request has been sent to Pastor Deola Phillips.'
        ]);
    }
}
