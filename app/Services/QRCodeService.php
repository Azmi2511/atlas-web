<?php

namespace App\Services;

use App\Models\QRToken;
use Carbon\Carbon;

class QRCodeService
{
    public function verify($token, $classId): bool
    {
        $qr = QRToken::where('token', $token)
            ->where('class_id', $classId)
            ->where('valid_for_date', Carbon::today()->toDateString())
            ->where('is_active', true)
            ->first();

        if (!$qr) return false;

        if ($qr->valid_until && Carbon::now()->format('H:i:s') > $qr->valid_until) {
            return false;
        }

        return true;
    }
}