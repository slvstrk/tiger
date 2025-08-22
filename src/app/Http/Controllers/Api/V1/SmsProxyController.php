<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\Api\V1\CancelRequestDto;
use App\DTOs\Api\V1\GetNumberRequestDto;
use App\DTOs\Api\V1\GetSmsRequestDto;
use App\DTOs\Api\V1\GetStatusRequestDto;
use App\Http\Requests\Api\V1\CancelNumberRequest;
use App\Http\Requests\Api\V1\GetNumberRequest;
use App\Http\Requests\Api\V1\GetSmsRequest;
use App\Http\Requests\Api\V1\GetStatusRequest;
use App\Services\Sms\SmsServiceInterface;
use App\Traits\HandleApiExceptions;
use Illuminate\Http\JsonResponse;

class SmsProxyController extends BaseApiController
{
    use HandleApiExceptions;

    public function __construct(
        private readonly SmsServiceInterface $smsService
    ) {}

    /**
     * задачи валидировать не было. но так обрежем лишние запросы к api
     * и дадим чуть более понятный ответ
     */
    public function getNumber(GetNumberRequest $request): JsonResponse
    {
        $getNumberDto = GetNumberRequestDto::fromArray($request->validated());
        $result = $this->smsService->getNumber($getNumberDto);
        return response()->json($result);
    }

    public function getSms(GetSmsRequest $request): JsonResponse
    {
        $getSmsDto = GetSmsRequestDto::fromArray($request->validated());
        try {
            return response()->json(
                $this->smsService->getSms($getSmsDto)
            );
        } catch (\Throwable $e) {
            return $this->handleApiExceptions($e, ['dto' => $getSmsDto->toArray()]);
        }
    }

    /**
     * В сервисе дополнительно сокращаем количество запросов при помощи redis
     */
    public function cancelNumber(CancelNumberRequest $request): JsonResponse
    {
        $cancelNumberDto = CancelRequestDto::fromArray($request->validated());

        try {
            return response()->json(
                $this->smsService->cancelNumber($cancelNumberDto)
            );
        } catch (\Throwable $e) {
            return $this->handleApiExceptions($e, ['dto' => $cancelNumberDto->toArray()]);
        }
    }

    public function getStatus(GetStatusRequest $request): JsonResponse
    {
        $getStatusDto = GetStatusRequestDto::fromArray($request->validated());
        try {
            return response()->json(
                $this->smsService->getStatus($getStatusDto)
            );
        } catch (\Throwable $e) {
            return $this->handleApiExceptions($e, ['dto' => $getStatusDto->toArray()]);
        }
    }
}
