<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\AuthController;
use Modules\User\Http\Controllers\UserController;

// Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('users', UserController::class)->names('user');
// });


Route::group([
    'prefix' => 'auth'
], function ($router) {

    // Route::post('login', [AuthController::class,'login'])->name('login');
    Route::post('register', [AuthController::class,'create']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [AuthController::class,'logout']);
        Route::post('refresh', [AuthController::class,'refresh']);
        Route::post('me', [AuthController::class,'me']);
    });
});