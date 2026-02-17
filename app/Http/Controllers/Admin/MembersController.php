<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Testimony; // Import the Testimony model
use Illuminate\Http\Request;

class MembersController extends Controller
{
    /**
     * Handle the Admin Dashboard and Management Tabs
     */
    public function index(Request $request)
    {
        // 1. Get Search Queries
        $memberSearch = $request->input('search'); // Global/Member search
        $testimonySearch = $request->input('testimony_search'); // Testimony specific search

        // 2. Member Statistics Calculation
        $target = 30000;
        $totalMembers = User::count();
        $progressPercent = $target > 0 ? ($totalMembers / $target) * 100 : 0;
        $progressPercent = min($progressPercent, 100);

        // 3. Testimony Statistics
        $stats = [
            'total'   => Testimony::count(),
            'pending' => Testimony::where('is_approved', false)->count(),
            'video'   => Testimony::whereNotNull('video_url')->where('video_url', '!=', '')->count(),
        ];

        // 4. Fetch Testimonies with Filtering
        // We use 'testimony_page' to prevent pagination conflicts with 'member_page'
        $testimonies = Testimony::query()
            ->when($testimonySearch, function ($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('group', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10, ['*'], 'testimony_page')
            ->appends(['testimony_search' => $testimonySearch, 'search' => $memberSearch]);

        // 5. Fetch Members with Filtering
        $members = User::query()
            ->when($memberSearch, function ($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('member_id', 'like', "%{$search}%")
                      ->orWhere('church_group', 'like', "%{$search}%")
                      ->orWhere('central_church', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15, ['*'], 'member_page')
            ->appends(['search' => $memberSearch, 'testimony_search' => $testimonySearch]);

        // 6. Return the main dashboard view with all data
        return view('admin.dashboard', [
            'members'         => $members,
            'totalMembers'    => $totalMembers,
            'target'          => $target,
            'progressPercent' => $progressPercent,
            'search'          => $memberSearch,
            'testimonies'     => $testimonies,
            'testimonySearch' => $testimonySearch,
            'stats'           => $stats,
        ]);
    }
}
