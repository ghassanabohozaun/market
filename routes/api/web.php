<?php

use App\Http\Controllers\Api\Admin\AddressesController;
use App\Http\Controllers\Api\Web\GlobalController;
use App\Http\Controllers\Api\Web\MailingBoxController;
use App\Http\Controllers\Api\Web\NotificationsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'web'], function () {
    ########################################### address routes  ##############################################################
    Route::controller(AddressesController::class)->group(function () {
        Route::get('get-countries', 'getCountries');
        Route::get('get-cities/{country_id}', 'getCities');
    });

    ########################################### globale routes  ##############################################################
    Route::controller(GlobalController::class)->group(function () {
        Route::get('get-settings', 'getSettings');
        Route::get('get-categories', 'getCategories');
        Route::get('get-sliders', 'getSliders');
        Route::get('get-pages', 'getPages');
    });

    ########################################### notifications routes  ##############################################################
    Route::controller(NotificationsController::class)->group(function () {
        Route::get('get-notificaions', 'notifications');
        Route::post('store-notificaion', 'store');
    });

    ########################################### mailing box routes  ##############################################################
    Route::controller(MailingBoxController::class)->group(function () {
        Route::get('get-mailing-list', 'mailingList');
        Route::post('store-mailing-email', 'store');
    });
});
