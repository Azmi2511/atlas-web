<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'class_id', 'date', 'check_in_time', 'check_out_time',
        'status', 'latitude', 'longitude', 'photo_selfie', 'face_matched',
        'qr_code', 'device_info', 'verified_by', 'location_id'
    ];

    protected $casts = [
        'date' => 'date',
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
        'face_matched' => 'boolean',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function classroom() { return $this->belongsTo(ClassRoom::class, 'class_id'); }
    public function verifier() { return $this->belongsTo(User::class, 'verified_by'); }
    public function location() { return $this->belongsTo(Location::class); }
    public function logs() { return $this->hasMany(AttendanceLog::class); }
}