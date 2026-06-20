<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\CountryRespurce;
use App\Services\Api\AddressService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    use ApiResponse;

    protected $addressService;
    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function getCountries()
    {
        $countries = $this->addressService->getCountries();
        $data = ['countries' => CountryRespurce::collection($countries)];
        return $this->ApiResponse($data, true, __('general.data_fetch_successfully'), 200);
    }

    public function getCities($country_id)
    {
        $cities = $this->addressService->getCities($country_id);
        $data = ['cities' => CityResource::collection($cities)];
        return $this->ApiResponse($data, true, __('general.data_fetch_successfully'), 200);
    }
}
