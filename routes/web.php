<?php
use App\Http\Controllers\Website\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Livewire\Livewire;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'as' => 'website.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        ########################################### Livewire  ##################################################################
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });
        ########################################### home routes ##################################################################
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::get('/market', [HomeController::class, 'market'])->name('market');
    },
);
