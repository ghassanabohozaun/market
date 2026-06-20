<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\CityService;
use App\Services\Dashboard\CountryService;

class DashboardController extends Controller
{
    protected $cityService, $countryService;
    public function __construct(CityService $cityService, CountryService $countryService )
    {
        $this->cityService = $cityService;
        $this->countryService = $countryService;
    }

    public function index()
    {
        $title = __('dashboard.home');

        return view('dashboard.home.index', compact(
            'title'
        ));
    }

    // addresses
    public function addresses()
    {
        $counties = $this->countryService->getAllCountriesWithoutRelations();
        $cities = $this->cityService->getAllCitiesWithoutRelation();
        return view('dashboard.address', compact('counties', 'cities'));
    }

}
