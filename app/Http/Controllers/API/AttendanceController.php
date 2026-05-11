<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SubmitAttendanceRequest;
use App\Http\Resources\API\AttendanceResource;
use App\Models\Attendance;
use App\Services\QRCodeService;
use App\Services\FaceRecognitionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function __construct(
        protected QRCodeService $qrService,
        protected FaceRecognitionService $faceService
    ) {}

    public function submit(SubmitAttendanceRequest $request)
    {
        $user = $request->user();
        $today = Carbon::today();

        // Cek apakah sudah absen hari ini
        $existing = Attendance::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan absen hari ini',
                'code' => 'ALREADY_ATTENDED'
            ], 409);
        }

        // Verifikasi QR Code
        $qrValid = $this->qrService->verify($request->qr_code, $request->class_id);
        if (!$qrValid) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code tidak valid atau sudah kadaluarsa',
                'code' => 'INVALID_QR'
            ], 422);
        }

        // Verifikasi hasil face recognition (client sudah melakukan matching)
        $faceResult = $this->faceService->validateResult(
            $request->boolean('face_matched', false),
            ['device_info' => $request->device_info]
        );

        // Simpan foto selfie (base64 ke file)
        $photoPath = null;
        if ($request->photo_selfie) {
            $photoPath = $this->saveBase64Image($request->photo_selfie, 'attendances');
        }

        // Simpan data absensi
        $attendance = Attendance::create([
            'user_id' => $user->id,
            'class_id' => $request->class_id,
            'date' => $today,
            'check_in_time' => Carbon::now(),
            'status' => $request->input('status', 'hadir'),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'photo_selfie' => $photoPath,
            'face_matched' => $faceResult,
            'qr_code' => $request->qr_code,
            'device_info' => $request->device_info,
            'verified_by' => null, // nanti diverifikasi admin
        ]);

        // Dispatch event realtime
        event(new \App\Events\AttendanceRecorded($attendance));

        return response()->json([
            'success' => true,
            'message' => 'Absen berhasil dicatat',
            'data' => new AttendanceResource($attendance)
        ], 201);
    }

    public function history(Request $request)
    {
        $attendances = $request->user()->attendances()
            ->with('class')
            ->orderBy('date', 'desc')
            ->paginate(15);

        return response()->json([
            'success' => true,
            'data' => AttendanceResource::collection($attendances),
            'meta' => [
                'current_page' => $attendances->currentPage(),
                'last_page' => $attendances->lastPage(),
                'total' => $attendances->total(),
            ]
        ]);
    }

    private function saveBase64Image($base64, $folder)
    {
        // Hapus header base64 jika ada (data:image/png;base64,)
        if (str_contains($base64, 'base64,')) {
            $base64 = substr($base64, strpos($base64, 'base64,') + 7);
        }

        $image = base64_decode($base64);
        $filename = $folder . '/' . uniqid() . '_' . time() . '.png';
        Storage::disk('public')->put($filename, $image);

        return $filename;
    }
}