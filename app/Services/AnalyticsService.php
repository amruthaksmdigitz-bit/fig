<?php

namespace App\Services;

use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;

class AnalyticsService
{
    protected $analytics;

    public function __construct(Analytics $analytics)
    {
        $this->analytics = $analytics;
    }

    public function getTotalVisitorsAndPageViews($days = 7)
    {
        return $this->analytics->fetchTotalVisitorsAndPageViews(Period::days($days));
    }

    public function getMostVisitedPages($days = 7, $maxResults = 10)
    {
        return $this->analytics->fetchMostVisitedPages(Period::days($days), $maxResults);
    }

    public function getTopReferrers($days = 7, $maxResults = 10)
    {
        return $this->analytics->fetchTopReferrers(Period::days($days), $maxResults);
    }

    public function getUserTypes($days = 7)
    {
        return $this->analytics->fetchUserTypes(Period::days($days));
    }

    public function getTopBrowsers($days = 7, $maxResults = 5)
    {
        return $this->analytics->fetchTopBrowsers(Period::days($days), $maxResults);
    }

    public function getRealtimeActiveUsers()
    {
        return $this->analytics->getAnalyticsService()
            ->data_realtime
            ->get('ga:' . config('analytics.property_id'), 'rt:activeUsers')
            ->totalsForAllResults['rt:activeUsers'] ?? 0;
    }

    public function getMetrics($days = 7)
    {
        $period = Period::days($days);
        
        $metrics = $this->analytics->performQuery(
            $period,
            'ga:sessions,ga:pageviews,ga:users,ga:bounceRate,ga:avgSessionDuration,ga:pageviewsPerSession'
        );

        return [
            'sessions' => $metrics->totalsForAllResults['ga:sessions'] ?? 0,
            'pageviews' => $metrics->totalsForAllResults['ga:pageviews'] ?? 0,
            'users' => $metrics->totalsForAllResults['ga:users'] ?? 0,
            'bounce_rate' => round($metrics->totalsForAllResults['ga:bounceRate'] ?? 0, 2),
            'avg_session_duration' => gmdate("H:i:s", $metrics->totalsForAllResults['ga:avgSessionDuration'] ?? 0),
            'pages_per_session' => round($metrics->totalsForAllResults['ga:pageviewsPerSession'] ?? 0, 2),
        ];
    }
}