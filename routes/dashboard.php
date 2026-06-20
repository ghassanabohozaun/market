<?php

use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\CitiesController;
use App\Http\Controllers\Dashboard\CountriesController;
use App\Http\Controllers\Dashboard\GovernoratesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DepartmentsController;
use App\Http\Controllers\Dashboard\GovernoratiesController;
use App\Http\Controllers\Dashboard\PagesController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\TagsController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\SlidersController;
use App\Http\Controllers\Dashboard\TasksController;
use App\Http\Middleware\CheckLockScreen;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'as' => 'dashboard.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        ########################################### Auth (Guest) ###########################################################
        Route::get('login', [AuthController::class, 'getLogin'])->name('get.login');
        Route::post('login', [AuthController::class, 'postLogin'])->name('post.login');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        ########################################### reset password  ######################################################################
        Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
            Route::controller(ForgetPasswordController::class)->group(function () {
                Route::get('email', 'showEmailForm')->name('get.email');
                Route::post('email', 'sendOTP')->name('post.email');
                Route::get('verify/{email?}', 'showVerifyOTPForm')->name('verify');
                Route::post('verify', 'verifyOTP')->name('post.verify');
            });

            Route::controller(ResetPasswordController::class)->group(function () {
                Route::get('reset/{email?}', 'showResetFrom')->name('reset');
                Route::post('reset', 'resetPasword')->name('post.reset');
            });
        });

        ########################################### protected routes  #####################################################################
        Route::group(['middleware' => ['auth:admin', CheckLockScreen::class]], function () {
            ########################################### Auth Protected #######################################################
            Route::get('lock-screen', [AuthController::class, 'lockScreen'])->name('lock.screen');
            Route::post('unlock-screen', [AuthController::class, 'unlock'])->name('unlock.screen');

            ########################################### home  ##########################################################################
            Route::get('/home', [DashboardController::class, 'index'])->name('index');

            ########################################### profile  routes ##########################################################################
            Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
            Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change.password');

            Route::group(['middleware' => 'can:settings'], function () {
                Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
                Route::put('/settings/{id?}', [SettingsController::class, 'update'])->name('settings.update');


            });

            ########################################### roles routes ######################################################################
            Route::group(['middleware' => 'can:roles'], function () {
                Route::resource('roles', RolesController::class)->except(['destroy']);
                Route::post('/roles/destroy', [RolesController::class, 'destroy'])->name('roles.destroy');
            });

            ########################################### admins routes  #####################################################################
            Route::group(['middleware' => 'can:admins'], function () {
                Route::resource('admins', AdminsController::class)->except(['destroy']);
                Route::post('/admins/destroy', [AdminsController::class, 'destroy'])->name('admins.destroy');
                Route::post('/admins/status', [AdminsController::class, 'changeStatus'])->name('admins.change.status');
            });

            ########################################### tasks routes ######################################################################
            Route::group(['middleware' => 'can:tasks'], function () {
                Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');
            });
            ########################################### addresses routes  ######################################################################
            Route::group(['as' => 'addresses.', 'middleware' => 'can:addresses'], function () {
                // countries routes
                Route::resource('countries', CountriesController::class)->except(['destroy']);
                Route::post('/countries/destroy', [CountriesController::class, 'destroy'])->name('countries.destroy');
                Route::post('/countries/status', [CountriesController::class, 'changeStatus'])->name('countries.change.status');
                Route::get('/country/{country_id?}/cities', [CountriesController::class, 'getAllCitiesByCountry'])->name('countries.get.cities.by.country.id');
                Route::get('/countries/autocomplete/country', [CountriesController::class, 'autocompleteCountry'])->name('countries.autocomplete.country');

                // governorates routes
                Route::resource('governorates', GovernoratesController::class)->except(['destroy']);
                Route::post('/governorates/destroy', [GovernoratesController::class, 'destroy'])->name('governorates.destroy');
                Route::post('/governorates/status', [GovernoratesController::class, 'changeStatus'])->name('governorates.change.status');
                Route::get('/governorates/autocomplete/governorate', [GovernoratesController::class, 'autocompleteGovernorate'])->name('governorates.autocomplete.governorate');

                // cities routes
                Route::resource('cities', CitiesController::class)->except(['destroy']);
                Route::post('/cities/destroy', [CitiesController::class, 'destroy'])->name('cities.destroy');
                Route::post('/cities/status', [CitiesController::class, 'changeStatus'])->name('cities.change.status');
                Route::get('/cities/autocomplete/city', [CitiesController::class, 'autocompleteCity'])->name('cities.autocomplete.city');
            });

            ########################################### employee routes  ######################################################################

            ########################################### sliders routes  ######################################################################
            Route::group(['middleware' => 'can:sliders'], function () {
                Route::resource('sliders', SlidersController::class)->except(['destroy']);
                Route::post('/sliders/destroy', [SlidersController::class, 'destroy'])->name('sliders.destroy');
                Route::post('/sliders/status', [SlidersController::class, 'changeStatus'])->name('sliders.change.status');
            });

            ########################################### pages routes  ######################################################################
            Route::group(['middleware' => 'can:pages'], function () {
                Route::resource('pages', PagesController::class)->except(['destroy']);
                Route::get('/pages/get/all', [PagesController::class, 'getAll'])->name('pages.get.all');
                Route::post('/pages/destroy/{id?}', [PagesController::class, 'destroy'])->name('pages.destroy');
                Route::post('/pages/status', [PagesController::class, 'changeStatus'])->name('pages.change.status');
            });

            ########################################### categories routes  ##########################################################
            Route::group(['middleware' => 'can:categories'], function () {
                Route::resource('categories', CategoriesController::class)->except(['show', 'edit']);
                Route::get('/categories-all', [CategoriesController::class, 'getAll'])->name('categories.all');
                Route::post('/categories/destroy', [CategoriesController::class, 'destroy'])->name('categories.destroy');
                Route::post('/categories/status', [CategoriesController::class, 'changeStatus'])->name('categories.change.status');
            });



            ########################################### tags routes  ##############################################################
            Route::group(['middleware' => 'can:tags'], function () {
                Route::resource('tags', TagsController::class)->except(['show', 'edit']);
                Route::get('/tags-all', [TagsController::class, 'getAll'])->name('tags.all');
                Route::post('/tags/destroy', [TagsController::class, 'destroy'])->name('tags.destroy');
                Route::post('/tags/status', [TagsController::class, 'changeStatus'])->name('tags.change.status');
            });

            ########################################### testimonials routes  ##############################################################
            Route::group(['middleware' => 'can:testimonials'], function () {
                Route::resource('testimonials', App\Http\Controllers\Dashboard\TestimonialsController::class)->except(['show', 'edit']);
                Route::post('/testimonials/destroy', [App\Http\Controllers\Dashboard\TestimonialsController::class, 'destroy'])->name('testimonials.destroy');
                Route::post('/testimonials/status', [App\Http\Controllers\Dashboard\TestimonialsController::class, 'changeStatus'])->name('testimonials.change.status');
            });


        });
    },
);
