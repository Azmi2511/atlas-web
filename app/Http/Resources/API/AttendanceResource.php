<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date->format('Y-m-d'),
            'check_in_time' => $this->check_in_time->format('H:i:s'),
            'status' => $this->status,
            'class_name' => $this->classrooms?->name,
            'verified' => $this->face_matched,
            'photo_url' => $this->photo_selfie ? Storage::url($this->photo_selfie) : null,
            'created_at' => $this->created_at->toISOString(),
        ];
    }
}