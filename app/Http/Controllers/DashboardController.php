<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use App\Http\Controllers\Controller;
use Cache;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'today_hadir' => Attendance::whereDate('date', today())->where('status', 'hadir')->count(),
            'today_izin'  => Attendance::whereDate('date', today())->where('status', 'izin')->count(),
            'today_sakit' => Attendance::whereDate('date', today())->where('status', 'sakit')->count(),
            'today_alpha' => Attendance::whereDate('date', today())->where('status', 'alpha')->count(),
            'online_users' => Cache::get('online_users', 0),
        ];

        $labels = [];
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('d M');
            $data[] = Attendance::whereDate('date', $date)->where('status', 'hadir')->count();
        }

        $recentAttendances = Attendance::with('user', 'classroom')
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'labels', 'data', 'recentAttendances'));
    }

    public function stats()
    {
        return response()->json([
            'today_hadir' => Attendance::whereDate('date', today())->where('status', 'hadir')->count(),
            'today_izin'  => Attendance::whereDate('date', today())->where('status', 'izin')->count(),
            'today_sakit' => Attendance::whereDate('date', today())->where('status', 'sakit')->count(),
            'today_alpha' => Attendance::whereDate('date', today())->where('status', 'alpha')->count(),
        ]);
    }
}