<?php

namespace App\Services\Sms;

use App\DTOs\Api\V1\CancelRequestDto;
use App\DTOs\Api\V1\GetNumberRequestDto;
use App\DTOs\Api\V1\GetSmsRequestDto;
use App\DTOs\Api\V1\GetStatusRequestDto;
use Illuminate\Http\Client\Response;

interface SmsServiceInterface
{
    public function getNumber(GetNumberRequestDto $getNumberDto): array;
    public function getSms(GetSmsRequestDto $getSmsDto): array;
    public function cancelNumber(CancelRequestDto $cancelSmsDto): array;
    public function getStatus(GetStatusRequestDto $getStatusDto): array;
    public function sendRequest(array $params): Response;
}
