<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AnalyticsService;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    protected $analyticsService;

    public function __construct(AnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
    }

    public function dashboard()
    {
        $days = request()->get('days', 7);
        
        $data = [
            'metrics' => $this->analyticsService->getMetrics($days),
            'mostVisitedPages' => $this->analyticsService->getMostVisitedPages($days),
            'topReferrers' => $this->analyticsService->getTopReferrers($days),
            'topBrowsers' => $this->analyticsService->getTopBrowsers($days),
            'userTypes' => $this->analyticsService->getUserTypes($days),
            'realtimeUsers' => $this->analyticsService->getRealtimeActiveUsers(),
            'selectedDays' => $days,
        ];

        return view('admin.analytics.dashboard', $data);
    }

    public function getChartData(Request $request)
    {
        $days = $request->get('days', 7);
        $visitorData = $this->analyticsService->getTotalVisitorsAndPageViews($days);
        
        $labels = [];
        $visitors = [];
        $pageViews = [];

        foreach ($visitorData as $item) {
            $labels[] = $item['date']->format('M d');
            $visitors[] = $item['visitors'];
            $pageViews[] = $item['pageViews'];
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Visitors',
                    'data' => $visitors,
                    'borderColor' => '#3B82F6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                ],
                [
                    'label' => 'Page Views',
                    'data' => $pageViews,
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                ]
            ]
        ]);
    }
}