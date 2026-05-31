<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\User;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        $userId = Auth::id();

        $pendingCount   = Project::where('user_id', '=', $userId, 'and')->where('status', '=', 'Pending', 'and')->count('*');
        $ongoingCount   = Project::where('user_id', '=', $userId, 'and')->where('status', '=', 'Ongoing', 'and')->count('*');
        $completedCount = Project::where('user_id', '=', $userId, 'and')->where('status', '=', 'Completed', 'and')->count('*');
        $completionMonth = Project::where('user_id', '=', $userId, 'and')
            ->where('status', '=', 'Completed', 'and')
            ->selectRaw("DATE_FORMAT(end_date, '%Y-%m') as month_key, DATE_FORMAT(end_date, '%b %Y') as month, COUNT(*) as count")
            ->groupBy('month_key', 'month')
            ->orderBy('month_key')
            ->get();

        $totalProjects = Project::count('*');
        $totalUsers = User::count('*');

        return view('Pages.dashboard', compact('pendingCount', 'ongoingCount', 'completedCount', 'completionMonth', 'totalProjects', 'totalUsers'));
    }
}