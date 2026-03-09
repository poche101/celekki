<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Testimony;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MembersController extends Controller
{
    /**
     * Handle the Admin Dashboard and Management Tabs
     */
    public function index(Request $request)
    {
        // 1. Get Search Queries
        $memberSearch = $request->input('search');
        $testimonySearch = $request->input('testimony_search');

        // 2. Member Statistics (SYNCHRONIZED)
        // We name it $totalMembers here to match the return and the Blade
        $totalMembers = User::count();
        $target = 30000;
        $progressPercent = $target > 0 ? min(($totalMembers / $target) * 100, 100) : 0;

        // 3. Comprehensive Statistics Array
        $stats = [
            'total_members'  => $totalMembers,
            'total'          => Testimony::count(),
            'pending'        => Testimony::where('is_approved', false)->count(),
            'video'          => Testimony::whereNotNull('video_url')->where('video_url', '!=', '')->count(),
            'total_logins'   => $totalMembers,

            // Safe checks for other models
            'total_prayers'  => class_exists(\App\Models\Prayer::class) ? \App\Models\Prayer::count() : 0,
            'total_episodes' => class_exists(\App\Models\Hlife::class) ? \App\Models\Hlife::count() : 0,
            'total_comments' => class_exists(\App\Models\LiveComment::class) ? \App\Models\LiveComment::count() : 0,
            'total_viewers'  => class_exists(\App\Models\LiveAttendance::class) ? \App\Models\LiveAttendance::count() : 0,
        ];

        // 4. Social Activity Feed (Viewers list)
        if (class_exists(\App\Models\LiveAttendance::class)) {
            $viewers = \App\Models\LiveAttendance::latest()->paginate(10, ['*'], 'viewers_page');
        } else {
            $viewers = new LengthAwarePaginator([], 0, 10, 1, ['path' => $request->url()]);
        }

        // 5. Prayer Requests (Lookup Collection)
        $prayers = class_exists(\App\Models\Prayer::class) ? \App\Models\Prayer::all() : collect();

        // 6. Paginated Lists (Members & Testimonies)
        $members = User::query()
            ->when($memberSearch, function ($q, $search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(15, ['*'], 'member_page')
            ->appends(['search' => $memberSearch]);

        $testimonies = Testimony::query()
            ->when($testimonySearch, function ($q, $search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10, ['*'], 'testimony_page')
            ->appends(['testimony_search' => $testimonySearch]);

        // 7. FINAL RETURN
dd($totalMembers);
        // Ensure the key 'totalMembers' exactly matches your Blade variable $totalMembers
        return view('admin.dashboard', [
            'totalMembers'    => $totalMembers,
            'stats'           => $stats,
            'members'         => $members,
            'target'          => $target,
            'progressPercent' => $progressPercent,
            'search'          => $memberSearch,
            'testimonies'     => $testimonies,
            'testimonySearch' => $testimonySearch,
            'viewers'         => $viewers,
            'prayers'         => $prayers,

        ]);
    }
}
