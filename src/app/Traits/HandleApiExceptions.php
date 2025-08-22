<?php

namespace App\Traits;

use App\Exceptions\SmsServiceException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

trait HandleApiExceptions
{
    protected function handleApiExceptions(Throwable $e, array $context = []): JsonResponse
    {
        if ($e instanceof SmsServiceException) {
            return response()->json([
                'code' => 'error',
                'message' => $e->getMessage(),
            ], 503);
        }

        Log::error('Unexpected API error', [
            'context' => $context,
            'exception' => $e->getMessage(),
        ]);

        return response()->json([
            'code' => 'error',
            'message' => 'Server error. Please contact the administrator',
        ], 500);
    }
}
