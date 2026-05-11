<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class SubmitAttendanceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'class_id' => 'required|exists:classes,id',
            'qr_code' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'photo_selfie' => 'required|string', // base64
            'face_matched' => 'boolean',
            'device_info' => 'nullable|string',
            'status' => 'nullable|in:hadir,izin,sakit', // default hadir
        ];
    }

    public function messages(): array
    {
        return [
            'class_id.required' => 'Kelas harus dipilih',
            'qr_code.required' => 'QR code wajib di-scan',
            'photo_selfie.required' => 'Foto selfie wajib diambil',
        ];
    }
}