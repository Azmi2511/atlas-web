<?php

namespace App\Services;

use App\Models\Attendance;

class AttendanceService
{
    public function checkin(array $data)
    {
        return Attendance::create([
            'user_id' => auth()->id(),
            'checkin_time' => now(),
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'qr_token' => $data['qr_token'],
            'selfie_image' => $data['selfie_image'] ?? null,
            'status' => 'present'
        ]);
    }
}