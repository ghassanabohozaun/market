<?php

namespace App\Repositories\Api;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Slider;

class GlobalRepository
{
    // get settings
    public function getSettings()
    {
        return Setting::first();
    }

    // get categories
    public function getCategories($limit = null)
    {
        if ($limit == null) {
            return Category::active()->latest()->get();
        }
        return Category::active()->limit($limit)->latest()->get();
    }

    // get sliders
    public function getSliders($limit = null)
    {
        if ($limit == null) {
            return Slider::active()->latest()->get();
        }
        return Slider::active()->limit($limit)->latest()->get();
    }

    // get pages
    public function getPages()
    {
        return Page::active()->latest()->get();
    }
}
