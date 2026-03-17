<?php

namespace App\Http\Controllers;

use App\Models\Viewer;
use App\Models\Prayer;
use App\Models\Testimony;
use App\Models\User;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the high-fidelity Analytics Dashboard.
     */
    public function index(Request $request)
    {
        // 1. Fetch Database Data for all tabs
        $viewers = Viewer::latest()->paginate(10, ['*'], 'viewer_page');
        $prayers = Prayer::latest()->get();

        // Define totalMembers explicitly for the compact() function
        $totalMembers = User::count();

        // Paginated data for Testimonies tab
        $testimonies = class_exists('\App\Models\Testimony')
            ? Testimony::latest()->paginate(10, ['*'], 'testimony_page')
            : collect();

        // Paginated data for Members tab
        $members = User::latest()->paginate(10, ['*'], 'member_page');

        // 2. Prepare the $stats array used by all tab cards
        $stats = [
            'total_logins'   => Viewer::count(),
            'total_prayers'  => $prayers->count(),
            'total_episodes' => Viewer::whereNotNull('episode_slug')->distinct('episode_slug')->count('episode_slug'),
            'pending'        => class_exists('\App\Models\Testimony') ? Testimony::where('status', 'pending')->count() : 0,
            'total'          => class_exists('\App\Models\Testimony') ? Testimony::count() : 0,
            'total_members'  => $totalMembers,
        ];

        // 3. Determine timeframe for Analytics (Default to weekly)
        $filter = $request->get('filter', 'weekly');
        $days = ($filter === 'monthly') ? 30 : 7;

        // 4. Cache key unique to the filter
        $cacheKey = "analytics_data_{$filter}";

        $analyticsData = Cache::remember($cacheKey, now()->addHours(1), function () use ($days) {
            try {
                if (app()->environment('local')) {
                    config(['analytics.guzzle_options' => ['verify' => false]]);
                }

                $data = Analytics::fetchTotalVisitorsAndPageViews(Period::days($days));

                return [
                    'dates' => $data->map(fn($item) => $item['date']->format('M d'))->toArray(),
                    'views' => $data->pluck('pageViews')->toArray(),
                    'total_views' => $data->sum('pageViews'),
                    'active_users' => Analytics::fetchTotalVisitorsAndPageViews(Period::days(1))->sum('activeUsers'),
                ];
            } catch (\Exception $e) {
                Log::error("Analytics Dashboard Error: " . $e->getMessage());
                return [
                    'dates' => [], 'views' => [], 'total_views' => 0, 'active_users' => 0, 'error' => $e->getMessage(),
                ];
            }
        });

        // 5. Extract Analytics Metrics
        $dates = $analyticsData['dates'];
        $views = $analyticsData['views'];
        $totalViews = $analyticsData['total_views'];
        $activeStreams = $analyticsData['active_users'];

        // 6. Progress Calculations
        $goal = 20000;
        $progressPercent = ($goal > 0) ? min(($totalViews / $goal) * 100, 100) : 0;
        $goalLabel = number_format($totalViews / 1000, 1) . 'k';

        // 7. Return view with all variables (added 'totalMembers' here)
        return view('admin.dashboard', compact(
            'viewers',
            'prayers',
            'testimonies',
            'members',
            'totalMembers', // <--- FIXED: Now explicitly passing the variable
            'stats',
            'dates',
            'views',
            'totalViews',
            'activeStreams',
            'progressPercent',
            'goalLabel',
            'filter'
        ));
    }

    /**
     * Export Social Engagement data as CSV
     */
    public function exportSocialData()
    {
        $viewers = Viewer::latest()->get();
        $filename = "social_engagement_report_" . now()->format('Y-m-d_His') . ".csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$filename\"",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($viewers) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM

            fputcsv($file, ['Viewer Name', 'Phone', 'Location', 'Episode', 'Date/Time']);

            foreach ($viewers as $viewer) {
                fputcsv($file, [
                    $viewer->name,
                    $viewer->phone,
                    $viewer->location ?? 'Global',
                    $viewer->episode_slug ?? 'N/A',
                    $viewer->created_at ? $viewer->created_at->format('Y-m-d H:i:s') : 'N/A'
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function destroyViewer($id)
{
    // 1. Find the record (replace 'Viewer' with your actual Model name)
    $viewer = \App\Models\Viewer::findOrFail($id);

    // 2. Delete it
    $viewer->delete();

    // 3. Redirect back with a success message
    return back()->with('success', 'Viewer record removed successfully.');
}

    /**
     * Generate and stream Google Analytics report CSV
     */
    public function export(Request $request)
    {
        $filter = $request->query('filter', 'weekly');
        $days = ($filter === 'monthly') ? 30 : 7;

        try {
            if (app()->environment('local')) {
                config(['analytics.guzzle_options' => ['verify' => false]]);
            }

            $data = Analytics::fetchTotalVisitorsAndPageViews(Period::days($days));

            if (!$data || $data->isEmpty()) {
                return redirect()->back()->with('error', 'No analytics data found.');
            }

            $filename = "analytics_report_{$filter}_" . now()->format('Y-m-d') . ".csv";

            $headers = [
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=\"$filename\"",
            ];

            $callback = function() use ($data) {
                $file = fopen('php://output', 'w');
                fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
                fputcsv($file, ['Report Date', 'Page Views', 'Active Users']);

                foreach ($data as $row) {
                    fputcsv($file, [
                        $row['date']->format('Y-m-d'),
                        $row['pageViews'] ?? 0,
                        $row['activeUsers'] ?? 0
                    ]);
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            Log::error("Analytics Export Error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Export failed: ' . $e->getMessage());
        }
    }
}
