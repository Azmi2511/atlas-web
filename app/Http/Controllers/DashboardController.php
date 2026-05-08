<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $role = "";
        if ($user->hasRole('admin')) {
            $role = "Admin";
        } elseif ($user->hasRole('teacher')) {
            $role = "Guru";
        } elseif ($user->hasRole('student')) {
            $role = "Siswa";
        }
        $totalUsers = User::count();
        $todayAttendance = Attendance::whereDate('created_at', today())->count();
        $todayPercent = $totalUsers > 0 ? ($todayAttendance / $totalUsers) * 100 : 0;
        $monthlyAttendance = Attendance::whereMonth('created_at', now()->month)
                                        ->whereYear('created_at', now()->year)
                                        ->count();
        $monthlyPercent = ($totalUsers > 0) ? ($monthlyAttendance / ($totalUsers * now()->daysInMonth)) * 100 : 0;
        $monthlyPercent = min(100, $monthlyPercent);

        return view('admin.dashboard', compact('totalUsers', 'todayAttendance', 'todayPercent', 'monthlyAttendance', 'monthlyPercent', 'role'));
    }
}