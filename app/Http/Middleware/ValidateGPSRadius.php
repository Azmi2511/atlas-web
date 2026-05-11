<?php

namespace App\Http\Middleware;

use App\Models\Location;
use Closure;
use Illuminate\Http\Request;

class ValidateGPSRadius
{
    public function handle(Request $request, Closure $next)
    {
        $classId = $request->input('class_id');
        $lat = $request->input('latitude');
        $lng = $request->input('longitude');

        if (!$lat || !$lng) {
            return response()->json([
                'message' => 'Lokasi GPS tidak tersedia',
                'code' => 'GPS_REQUIRED'
            ], 422);
        }

        $locations = Location::where('is_active', true)->get();

        $withinRadius = false;
        foreach ($locations as $location) {
            $distance = $this->haversineGreatCircleDistance($lat, $lng, $location->latitude, $location->longitude);
            if ($distance <= $location->radius) {
                $withinRadius = true;
                break;
            }
        }

        if (!$withinRadius) {
            return response()->json([
                'message' => 'Anda berada di luar radius yang diizinkan untuk absen',
                'code' => 'OUT_OF_RADIUS'
            ], 422);
        }

        return $next($request);
    }

    private function haversineGreatCircleDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371000; // meter
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng/2) * sin($dLng/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $earthRadius * $c;
    }
}