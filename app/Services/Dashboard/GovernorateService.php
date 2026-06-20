<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\GovernorateRepository;

class GovernorateService
{
    protected $governorateRepository;

    // __construct
    public function __construct(GovernorateRepository $governorateRepository)
    {
        $this->governorateRepository = $governorateRepository;
    }

    // get governorate
    public function getGovernorate($id)
    {
        $governorate = $this->governorateRepository->getGovernorate($id);
        if (!$governorate) {
            return false;
        }
        return $governorate;
    }

    // get governorates
    public function getGovernorates($filters = [])
    {
        return $this->governorateRepository->getGovernorates($filters);
    }

    // get active governorates
    public function getActiveGovernorates($countryId = null)
    {
        return $this->governorateRepository->getActiveGovernorates($countryId);
    }

    // get all governorates without relation
    public function getAllGovernoratesWithoutRelation()
    {
        return $this->governorateRepository->getAllGovernoratesWithoutRelation();
    }

    // store governorate
    public function storeGovernorate($request)
    {
        $governorate = $this->governorateRepository->storeGovernorate($request);
        if (!$governorate) {
            return false;
        }
        return $governorate;
    }

    // update governorate
    public function updateGovernorate($request, $id)
    {
        $governorate = self::getGovernorate($id);
        if (!$governorate) {
            return false;
        }
        $governorate = $this->governorateRepository->updateGovernorate($request, $id);
        if (!$governorate) {
            return false;
        }
        return $governorate;
    }

    // destroy governorate
    public function destroyGovernorate($id)
    {
        $governorate = self::getGovernorate($id);

        if (!$governorate) {
            return 'not_found';
        }

        // Check for restrictive relations
        if (method_exists($governorate, 'checkRestrictiveRelations')) {
            $governorate->checkRestrictiveRelations();
        }

        $result = $this->governorateRepository->destroyGovernorate($governorate);
        return $result ? 'success' : 'failed';
    }

    // change status
    public function changeStatus($id, $status)
    {
        $governorate = self::getGovernorate($id);
        if (!$governorate) {
            return false;
        }
        $governorate = $this->governorateRepository->changeStatus($governorate, $status);
        if (!$governorate) {
            return false;
        }
        return $governorate;
    }

    // autocomplete
    public function autocompleteGovernorate($searchValue, $countryId = null)
    {
        return $this->governorateRepository->autocompleteGovernorate($searchValue, $countryId);
    }
}
