<?php

namespace App\Events;

use App\Models\Attendance;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AttendanceRecorded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function broadcastOn()
    {
        return new Channel('attendances');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->attendance->id,
            'user_name' => $this->attendance->user->name,
            'class_name' => $this->attendance->classroom->name ?? '-',
            'check_in_time' => $this->attendance->check_in_time->format('H:i:s'),
            'status' => $this->attendance->status,
        ];
    }
}