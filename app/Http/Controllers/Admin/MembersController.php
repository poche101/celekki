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

        // 2. Member Statistics Calculation (INTEGERS)
        $target = 30000;
        $totalMembersCount = User::count();
        $progressPercent = $target > 0 ? ($totalMembersCount / $target) * 100 : 0;
        $progressPercent = min($progressPercent, 100);

        // 3. Comprehensive Statistics Array
        $stats = [
            'total'          => Testimony::count(),
            'pending'        => Testimony::where('is_approved', false)->count(),
            'video'          => Testimony::whereNotNull('video_url')->where('video_url', '!=', '')->count(),
            'total_logins'   => User::count(),

            // Safe checks for model counts
            'total_prayers'  => class_exists(\App\Models\Prayer::class) ? \App\Models\Prayer::count() : 0,
            'total_episodes' => class_exists(\App\Models\Hlife::class) ? \App\Models\Hlife::count() : 0,
            'total_comments' => class_exists(\App\Models\LiveComment::class) ? \App\Models\LiveComment::count() : 0,
            'total_viewers'  => class_exists(\App\Models\LiveAttendance::class) ? \App\Models\LiveAttendance::count() : 0,
        ];

        // 4. Attendance/Viewer Statistics (PAGINATED)
        if (class_exists(\App\Models\LiveAttendance::class)) {
            $viewers = \App\Models\LiveAttendance::query()->latest()->paginate(10, ['*'], 'viewers_page');
        } else {
            $viewers = new LengthAwarePaginator([], 0, 10, 1, ['path' => $request->url()]);
        }

        // 4.5 Prayer Requests Statistics (NEW: Defines the $prayers variable)
        if (class_exists(\App\Models\Prayer::class)) {
            $prayers = \App\Models\Prayer::query()->latest()->paginate(10, ['*'], 'prayers_page');
        } else {
            // Safe fallback to prevent "Undefined Variable" and "firstItem() on int" errors
            $prayers = new LengthAwarePaginator([], 0, 10, 1, [
                'path' => $request->url(),
                'query' => $request->query(),
            ]);
        }

        // 5. Fetch Testimonies (PAGINATED OBJECT)
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

        // 6. Fetch Members (PAGINATED OBJECT)
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

        // 7. Return the view with all required variables
        return view('admin.dashboard', [
            'members'         => $members,
            'totalMembers'    => $totalMembersCount,
            'target'          => $target,
            'progressPercent' => $progressPercent,
            'search'          => $memberSearch,
            'testimonies'     => $testimonies,
            'testimonySearch' => $testimonySearch,
            'stats'           => $stats,
            'viewers'         => $viewers,
            'prayers'         => $prayers, // Now correctly defined above
        ]);
    }
}
