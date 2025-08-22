<?php

use App\Http\Controllers\Api\V1\SmsProxyController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {

    Route::get('/getNumber', [SmsProxyController::class, 'getNumber']);
    Route::get('/cancelNumber', [SmsProxyController::class, 'cancelNumber']);
    Route::get('/getSms', [SmsProxyController::class, 'getSms']);

    Route::get('/getStatus', [SmsProxyController::class, 'getStatus']);

});
