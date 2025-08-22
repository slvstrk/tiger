<?php

namespace App\Services\Sms;

use App\DTOs\Api\V1\CancelRequestDto;
use App\DTOs\Api\V1\GetNumberRequestDto;
use App\DTOs\Api\V1\GetSmsRequestDto;
use App\DTOs\Api\V1\GetStatusRequestDto;
use App\Exceptions\SmsServiceException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class PostBackSmsService implements SmsServiceInterface
{
    const CANCEL_NUMBER_CACHE_TTL = 600;

    public function __construct(
        private $baseUrl = null
    )
    {
        $this->baseUrl = config('services.postBackSms.baseUrl');
    }

    public function getNumber(GetNumberRequestDto $getNumberDto): array
    {
        $response = $this->sendRequest($getNumberDto->toArray());
        return $response->json();
    }

    public function getSms(GetSmsRequestDto $getSmsDto): array
    {
        $response = $this->sendRequest($getSmsDto->toArray());
        return $response->json();
    }

    public function cancelNumber(CancelRequestDto $cancelSmsDto): array
    {
        $activation = $cancelSmsDto->activation;
        $redisKey = 'smsProxy:canceledActivation:' . $activation;

        if (Redis::exists($redisKey)) {
            $cachedData = Redis::get($redisKey);
            Log::info("Return data from redis: key=$redisKey, value=$cachedData");
            return json_decode($cachedData, true);
        }

        $response = $this->sendRequest($cancelSmsDto->toArray());

        $responseData = $response->json();

        if ($responseData['status'] ?? null === 'canceled') {
            Redis::setex($redisKey, self::CANCEL_NUMBER_CACHE_TTL, json_encode($responseData));
        }

        return $response->json();
    }

    public function getStatus(GetStatusRequestDto $getStatusDto): array
    {
        $response = $this->sendRequest($getStatusDto->toArray());
        return $response->json();
    }

    public function sendRequest(array $params): Response
    {
        try {
            $response = Http::get($this->baseUrl, $params);
            $response->throw();
            return $response;

        } catch (RequestException $e) {

            Log::error('SmsService request failed', [
                'error_message' => $e->getMessage(),
                'params' => $params
            ]);

            throw new SmsServiceException('Sms service is currently unavailable.');
        }
    }
}
