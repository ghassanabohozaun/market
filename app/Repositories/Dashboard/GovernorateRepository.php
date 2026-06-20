<?php

namespace App\Repositories\Dashboard;

use App\Models\Governorate;
use App\Traits\QueryTrait;

class GovernorateRepository
{
    use QueryTrait;

    // get governorate
    public function getGovernorate($id)
    {
        return Governorate::find($id);
    }

    // get governorates
    public function getGovernorates($filters = [])
    {
        $governorates = Governorate::with('country')->withCount(['cities'])
            ->when(!empty($filters['search_term']), function ($query) use ($filters) {
                $searchTerm = mb_strtolower($filters['search_term'], 'UTF-8');
                $query->where(function ($q) use ($searchTerm) {
                    $q->whereRaw('LOWER(name->"$.en") like ?', ['"%' . $searchTerm . '%"'])
                        ->orWhereRaw('LOWER(name->"$.ar") like ?', ['"%' . $searchTerm . '%"']);
                });
            })
            ->when(!empty($filters['country_id']), function ($query) use ($filters) {
                $query->where('country_id', $filters['country_id']);
            })
            ->orderByDesc('id')
            ->paginate(10);
        return $governorates;
    }

    // get active governorates
    public function getActiveGovernorates($countryId = null)
    {
        return Governorate::where('status', 1)
            ->when($countryId, function($query) use ($countryId) {
                $query->where('country_id', $countryId);
            })
            ->get();
    }

    // get all governorates without relations
    public function getAllGovernoratesWithoutRelation()
    {
        return Governorate::get();
    }

    // store governorate
    public function storeGovernorate($request)
    {
        $governorate = Governorate::create([
            'name' => [
                'en' => $request->name['en'],
                'ar' => $request->name['ar'],
            ],
            'country_id' => $request->country_id,
            'status' => 1,
        ]);
        return $governorate;
    }

    // update governorate
    public function updateGovernorate($request, $id)
    {
        $governorate = self::getGovernorate($id);
        $governorate->update([
            'name' => [
                'en' => $request->name['en'],
                'ar' => $request->name['ar'],
            ],
            'country_id' => $request->country_id,
        ]);

        return $governorate;
    }

    // destroy governorate
    public function destroyGovernorate($governorate)
    {
        return $governorate->forceDelete();
    }

    // change status
    public function changeStatus($governorate, $status)
    {
        $governorate->update([
            'status' => $status,
        ]);
        return $governorate;
    }

    // autocomplete governorate
    public function autocompleteGovernorate($searchValue, $countryId = null)
    {
        return $this->genericSearch(
            Governorate::class,
            $searchValue,
            ['name->en', 'name->ar'],
            ['name->en as governorate_en', 'name->ar as governorate_ar', 'id'],
            function ($query) use ($countryId) {
                if ($countryId) {
                    $query->where('country_id', $countryId);
                }
                $query->where('status', 1);
            }
        );
    }
}
