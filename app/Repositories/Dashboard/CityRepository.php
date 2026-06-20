<?php

namespace App\Repositories\Dashboard;

use App\Models\City;
use App\Traits\QueryTrait;

class CityRepository
{
    use QueryTrait;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // get city
    public function getCity($id)
    {
        return City::find($id);
    }

    // get cities
    public function getCities($filters = [])
    {
        $cities = City::with('governorate.country')
            ->when(!empty($filters['search_term']), function ($query) use ($filters) {
                $searchTerm = mb_strtolower($filters['search_term'], 'UTF-8');
                $query->where(function ($q) use ($searchTerm) {
                    $q->whereRaw('LOWER(name->"$.en") like ?', ['"%' . $searchTerm . '%"'])
                        ->orWhereRaw('LOWER(name->"$.ar") like ?', ['"%' . $searchTerm . '%"']);
                });
            })
            ->when(!empty($filters['governorate_id']), function ($query) use ($filters) {
                $query->where('governorate_id', $filters['governorate_id']);
            })
            ->orderByDesc('id')
            ->paginate(10);
        return $cities;
    }

    // get active cities
    public function getActiveCities()
    {
        return City::where('status', 1)->get();
    }

    // get cities without Relations
    public function getAllCitiesWithoutRelation()
    {
        return City::get();
    }


    // store city
    public function storeCity($request)
    {
        $city = City::create([
            'name' => [
                'en' => $request->name['en'],
                'ar' => $request->name['ar'],
            ],
            'governorate_id' => $request->governorate_id,
        ]);
        return $city;
    }

    // update city
    public function updateCity($request, $id)
    {
        $city = self::getCity($id);
        $city->update([
            'name' => [
                'en' => $request->name['en'],
                'ar' => $request->name['ar'],
            ],
            'governorate_id' => $request->governorate_id,
        ]);

        return $city;
    }

    // destroy city
    public function destroyCity($city)
    {
        return $city->forceDelete();
    }
    // change status
    public function changeStatus($city, $status)
    {
        $city->update([
            'status' => $status,
        ]);
        return $city;
    }

    // autocomplete city
    public function autocompleteCity($searchValue, $governorateId = null)
    {
        return $this->genericSearch(
            City::class,
            $searchValue,
            ['name->en', 'name->ar'],
            ['name->en as city_en', 'name->ar as city_ar', 'id'],
            function ($query) use ($governorateId, $searchValue) {
                if ($governorateId) {
                    $query->where('governorate_id', $governorateId);
                } elseif (empty($searchValue)) {
                    $query->whereRaw('1 = 0');
                }
            }
        );
    }
}
