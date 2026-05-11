<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QRToken extends Model
{
    protected $fillable = ['token', 'class_id', 'location_id', 'valid_for_date', 'valid_until', 'is_active'];
    protected $casts = [
        'valid_for_date' => 'date',
        'valid_until' => 'datetime',
        'is_active' => 'boolean',
    ];
    public function classroom() { return $this->belongsTo(ClassRoom::class); }
    public function location() { return $this->belongsTo(Location::class); }
}