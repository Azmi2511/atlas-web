<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class FaceRecognitionService
{
    public function validateResult(bool $clientResult, array $metadata = []): bool
    {
        Log::channel('face_audit')->info('Face recognition result', [
            'result' => $clientResult,
            'metadata' => $metadata,
            'timestamp' => now(),
        ]);

        return $clientResult;
    }
}