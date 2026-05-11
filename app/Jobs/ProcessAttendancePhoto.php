<?php

namespace App\Jobs;

use App\Models\Attendance;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessAttendancePhoto implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function handle()
    {
        if ($this->attendance->photo_selfie && Storage::disk('public')->exists($this->attendance->photo_selfie)) {
            $path = Storage::disk('public')->path($this->attendance->photo_selfie);
            $image = Image::make($path)->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image->save();
        }
    }
}