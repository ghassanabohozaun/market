<?php

use App\Models\Admin;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Governorate;
use App\Models\Setting;
use Illuminate\Support\Facades\Config;



//  setting Helper Function
if (!function_exists('setting')) {
    function setting()
    {
        return Setting::orderBy('id', 'desc')->first();
    }
}

// test
//  get language Helper Function
if (!function_exists('Lang')) {
    function Lang()
    {
        return app()->getLocale();
    }
}

//  get admin Helper Function
if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin');
    }
}

//  get web Helper Function
if (!function_exists('web')) {
    function web()
    {
        return auth()->guard('web');
    }
}


if (!function_exists('slug')) {
    function slug($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $stringToLower = strtolower($string);
        return preg_replace('/[^\w\s\-]+/u', '', $stringToLower);
    }
}

if (!function_exists('replaceHyphensWithSpaces')) {
    function replaceHyphensWithSpaces($string)
    {
        return $string = str_replace('-', ' ', $string); // Replaces all hyphens with spaces.
    }

    //  get admin count Helper Function
    if (!function_exists('adminCount')) {
        function adminCount()
        {
            return Admin::count();
        }
    }

    //  get governorates count Helper Function
    if (!function_exists('governoratesCount')) {
        function governoratesCount()
        {
            return Governorate::count();
        }
    }


    // month name  in arabic
    if (!function_exists('monthNameArabic')) {
        function monthNameArabic($monthNumber)
        {
            $months = [
                1 => 'يناير',
                2 => 'فبراير',
                3 => 'مارس',
                4 => 'أبريل',
                5 => 'مايو',
                6 => 'يونيو',
                7 => 'يوليو',
                8 => 'أغسطس',
                9 => 'سبتمبر',
                10 => 'أكتوبر',
                11 => 'نوفمبر',
                12 => 'ديسمبر',
            ];
            return $months[$monthNumber] ?? null; // يعيد الاسم أو null إذا لم يكن الرقم صحيحاً
        }
    }

    // greeting
    if (!function_exists('greeting')) {
        function greeting()
        {
            $hour = now()->format('H');
            if ($hour >= 5 && $hour < 12) {
                return __('general.good_morning');
            } elseif ($hour >= 12 && $hour < 17) {
                return __('general.good_afternoon');
            } elseif ($hour >= 17 && $hour < 21) {
                return __('general.good_evening');
            } else {
                return __('general.good_night');
            }
        }
    }

     //  get admin count Helper Function
    if (!function_exists('adminsCount')) {
        function adminsCount()
        {
            return Admin::count();
        }
    }

    //  get country count Helper Function
    if (!function_exists('countriesCount')) {
        function countriesCount()
        {
            return Country::count();
        }
    }

    //  get city count Helper Function
    if (!function_exists('citiesCount')) {
        function citiesCount()
        {
            return City::count();
        }
    }


    //  get categories count Helper Function
    if (!function_exists('categoriesCount')) {
        function categoriesCount()
        {
            return Category::count();
        }
    }
}
