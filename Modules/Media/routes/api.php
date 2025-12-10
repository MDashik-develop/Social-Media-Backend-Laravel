<?php

use Illuminate\Support\Facades\Route;
use Modules\Media\Http\Controllers\MediaController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
});

Route::group([
    'prefix' => 'auth/media'
], function ($router) {


    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/', [MediaController::class, 'index']);
        Route::post ('/create', [MediaController::class, 'create']);
    });
});