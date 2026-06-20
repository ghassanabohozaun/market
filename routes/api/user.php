<?php

use App\Http\Controllers\Api\User\Auth\LoginController;
use App\Http\Controllers\Api\User\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:user-api');

    ########################################### auth user api routes ##################################################################
    Route::group(['middleware' => 'auth:user-api'], function () {
        Route::get('testAuth', function () {
            return 'User Authenticated';
        });
    });
});
