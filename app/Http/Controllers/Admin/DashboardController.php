<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total users count
        $totalUsers = User::count();
        
        // New users in last 30 days
        $newUsersLastMonth = User::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        
        // Active users (last 7 days) - using last_login_at
        $activeUsers = User::where('last_login_at', '>=', Carbon::now()->subDays(7))->count();
        
        // Users registered today
        $usersToday = User::whereDate('created_at', Carbon::today())->count();
        
        // Verified users
        $verifiedUsers = User::whereNotNull('email_verified_at')->count();
        
        // Inactive users (no login in 30 days)
        $inactiveUsers = User::where(function($query) {
            $query->where('last_login_at', '<', Carbon::now()->subDays(30))
                  ->orWhereNull('last_login_at');
        })->count();
        
        // Remove or comment out profile-related code
        // $usersWithProfile = User::has('profile')->count();
        $usersWithProfile = 0; // Set to 0 or remove from compact()
        
        // Recent users (last 10)
        $recentUsers = User::latest()->take(10)->get();
        
        // Paginated user list
        $users = User::latest()->paginate(10);
        
        // Calculate growth rate
        $previousMonthCount = User::whereBetween('created_at', 
            [Carbon::now()->subMonths(2), Carbon::now()->subMonth()]
        )->count();
        
        $growthRate = $previousMonthCount > 0 
            ? round((($newUsersLastMonth - $previousMonthCount) / $previousMonthCount) * 100, 2)
            : 0;
            
        // Average daily registration (last 30 days)
        $avgDaily = $newUsersLastMonth > 0 ? round($newUsersLastMonth / 30, 1) : 0;
        
        // Average monthly registration (last 6 months)
        $sixMonthsAgo = Carbon::now()->subMonths(6);
        $totalLast6Months = User::where('created_at', '>=', $sixMonthsAgo)->count();
        $avgMonthly = round($totalLast6Months / 6, 1);
        
        // Monthly growth (compared to previous month)
        $monthlyGrowth = $previousMonthCount > 0 
            ? round((($newUsersLastMonth - $previousMonthCount) / $previousMonthCount) * 100, 2)
            : ($newUsersLastMonth > 0 ? 100 : 0);
            
        // Churn rate (percentage of inactive users)
        $churnRate = $totalUsers > 0 ? round(($inactiveUsers / $totalUsers) * 100, 2) : 0;

        return view('admin.dashboard', compact(
            'totalUsers',
            'newUsersLastMonth',
            'activeUsers',
            'usersToday',
            'verifiedUsers',
            'inactiveUsers',
            // 'usersWithProfile', // Remove this
            'recentUsers',
            'users',
            'growthRate',
            'avgDaily',
            'avgMonthly',
            'monthlyGrowth',
            'churnRate'
        ));
    }
    
    public function getUserStats(Request $request)
    {
        $range = $request->get('range', '30days');
        
        switch ($range) {
            case '7days':
                $days = 7;
                break;
            case '3months':
                $days = 90;
                break;
            case '6months':
                $days = 180;
                break;
            case 'year':
                $days = 365;
                break;
            default:
                $days = 30;
        }
        
        $labels = [];
        $values = [];
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays($days);
        
        // Generate data for each day
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $labels[] = $currentDate->format('M d');
            $count = User::whereDate('created_at', $currentDate)->count();
            $values[] = $count;
            $currentDate->addDay();
        }
        
        return response()->json([
            'labels' => $labels,
            'values' => $values
        ]);
    }
}