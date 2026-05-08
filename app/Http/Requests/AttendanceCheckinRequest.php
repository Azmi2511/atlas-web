<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceCheckinRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'latitude' => ['required'],
            'longitude' => ['required'],
            'qr_token' => ['required'],
            'selfie_image' => ['nullable'],
        ];
    }
}