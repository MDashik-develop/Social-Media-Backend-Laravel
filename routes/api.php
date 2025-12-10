<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::group([
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', [\Modules\User\Http\Controllers\AuthController::class, 'login'])->name('login');
});