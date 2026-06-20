<?php

namespace App\Http\Controllers\Api\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\PageResource;
use App\Http\Resources\SettingResource;
use App\Http\Resources\SliderResource;
use App\Services\Api\GlobalService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    use ApiResponse;

    protected $globalService;
    public function __construct(GlobalService $globalService)
    {
        $this->globalService = $globalService;
    }

    // get settings
    public function getSettings()
    {
        $settings = $this->globalService->getSettings();
        $data = ['setting' => new SettingResource($settings)];
        return $this->ApiResponse($data, true, __('general.data_fetch_successfully'), 200);
    }

    // get categories
    public function getCategories()
    {
        $categories = $this->globalService->getCategories();
        $data = ['categories' => CategoryResource::collection($categories)];
        return $this->ApiResponse($data, true, __('general.data_fetch_successfully'), 200);
    }

    // get sliders
    public function getSliders()
    {
        $sliders = $this->globalService->getSliders();
        $data = ['slidrrs' => SliderResource::collection($sliders)];
        return $this->ApiResponse($data, true, __('general.data_fetch_successfully'), 200);
    }

    // get pages
    public function getPages()
    {
        $pages = $this->globalService->getPages();
        $data = ['pages' => PageResource::collection($pages)];
        return $this->ApiResponse($data, true, __('general.data_fetch_successfully'), 200);
    }
}
