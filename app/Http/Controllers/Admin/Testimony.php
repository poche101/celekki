<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    // ... your existing index and store methods ...

    /**
     * Admin Dashboard View
     */
    public function adminIndex()
    {
        // Fetch all for admin management, paginated
        $testimonies = Testimony::latest()->paginate(10);

        // Stats for the dashboard cards
        $stats = [
            'total' => Testimony::count(),
            'pending' => Testimony::where('is_approved', false)->count(),
            'video' => Testimony::whereNotNull('video_url')->count(),
        ];

        return view('admin.tabs.testimonies', compact('testimonies', 'stats'));
    }

    /**
     * Fast Approval Toggle
     */
    public function toggleApproval(Testimony $testimony)
    {
        $testimony->update(['is_approved' => !$testimony->is_approved]);

        return back()->with('success', 'Status updated successfully!');
    }

    public function destroy(Testimony $testimony)
    {
        $testimony->delete();
        return back()->with('success', 'Testimony deleted permanently.');
    }
}
