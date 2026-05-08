<?php

namespace App\Http\Controllers\API;

use App\Services\AttendanceService;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceCheckinRequest;

class AttendanceController extends Controller
{
    public function __construct(
        protected AttendanceService $attendanceService
    ) {}

    public function checkin(AttendanceCheckinRequest $request)
    {
        $attendance = $this->attendanceService
            ->checkin($request->validated());

        return response()->json([
            'message' => 'Checkin success',
            'data' => $attendance,
        ]);
    }
}