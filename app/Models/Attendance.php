<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'checkin_time',
        'checkout_time',
        'latitude',
        'longitude',
        'qr_token',
        'selfie_image',
        'status'
    ];

    protected $casts = [
        'checkin_time' => 'datetime',
        'checkout_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}