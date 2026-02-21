<?php

namespace App\Http\Controllers;

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
        // 1. Determine timeframe (Default to weekly)
        $filter = $request->get('filter', 'weekly');
        $days = ($filter === 'monthly') ? 30 : 7;

        // 2. Cache key unique to the filter
        $cacheKey = "analytics_data_{$filter}";

        $analyticsData = Cache::remember($cacheKey, now()->addHours(1), function () use ($days) {
            try {
                // TEMPORARY BYPASS FOR LOCAL TESTING
                if (app()->environment('local')) {
                    config(['analytics.guzzle_options' => ['verify' => false]]);
                }

                // Fetch visitors and page views
                $data = Analytics::fetchTotalVisitorsAndPageViews(Period::days($days));

                return [
                    'dates' => $data->map(fn($item) => $item['date']->format('M d'))->toArray(),
                    'views' => $data->pluck('pageViews')->toArray(),
                    'total_views' => $data->sum('pageViews'),
                    // Fetch active users for the current day (last 24h)
                    'active_users' => Analytics::fetchTotalVisitorsAndPageViews(Period::days(1))->sum('activeUsers'),
                ];
            } catch (\Exception $e) {
                // Log SSL or API errors for local debugging
                Log::error("Analytics Dashboard Error: " . $e->getMessage());

                return [
                    'dates' => [],
                    'views' => [],
                    'total_views' => 0,
                    'active_users' => 0,
                    'error' => $e->getMessage(),
                ];
            }
        });

        // 3. Extract Metrics
        $dates = $analyticsData['dates'];
        $views = $analyticsData['views'];
        $totalViews = $analyticsData['total_views'];
        $activeStreams = $analyticsData['active_users'];

        // 4. Calculate progress toward target (20k benchmark)
        $goal = 20000;
        $progressPercent = ($goal > 0) ? min(($totalViews / $goal) * 100, 100) : 0;
        $goalLabel = number_format($totalViews / 1000, 1) . 'k';

        // 5. Placeholder for external stats
        $testimoniesCount = 0;

        return view('admin.partials.dashboard-tab', compact(
            'dates',
            'views',
            'totalViews',
            'activeStreams',
            'progressPercent',
            'goalLabel',
            'filter',
            'testimoniesCount'
        ));
    }

    /**
     * Generate and stream a CSV report based on the active filter.
     */
    public function export(Request $request)
    {
        // Explicitly check for the filter to ensure report matches the UI view
        $filter = $request->query('filter', 'weekly');
        $days = ($filter === 'monthly') ? 30 : 7;

        try {
            // TEMPORARY BYPASS FOR LOCAL TESTING
            if (app()->environment('local')) {
                config(['analytics.guzzle_options' => ['verify' => false]]);
            }

            // Fetch fresh data for the report
            $data = Analytics::fetchTotalVisitorsAndPageViews(Period::days($days));

            // If Google returns nothing, redirect back with a message
            if (!$data || $data->isEmpty()) {
                return redirect()->back()->with('error', 'No analytics data found for the ' . $filter . ' period.');
            }

            $filename = "analytics_report_{$filter}_" . now()->format('Y-m-d_His') . ".csv";

            // Set specific headers for browser download trigger
            $headers = [
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=\"$filename\"",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];

            $callback = function() use ($data) {
                $file = fopen('php://output', 'w');

                // Add UTF-8 BOM for Excel compatibility
                fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

                // Add CSV Header row
                fputcsv($file, ['Report Date', 'Page Views', 'Active Users']);

                foreach ($data as $row) {
                    // Ensure date is formatted correctly even if the API object varies
                    $date = ($row['date'] instanceof \DateTimeInterface)
                        ? $row['date']->format('Y-m-d')
                        : $row['date'];

                    fputcsv($file, [
                        $date,
                        $row['pageViews'] ?? 0,
                        $row['activeUsers'] ?? 0
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);

        } catch (\Exception $e) {
            Log::error("Analytics Export Error: " . $e->getMessage());

            // Check for the specific SSL error and provide a helpful hint
            $message = $e->getMessage();
            if (str_contains($message, 'SSL certificate problem')) {
                $message = 'Local SSL Error: Connection was blocked. The verify => false bypass is required locally.';
            }

            return redirect()->back()->with('error', 'Export failed: ' . $message);
        }
    }
}
