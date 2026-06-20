<?php

namespace App\Services\Api;

use App\Repositories\Api\AddressRepository;

class AddressService
{
    protected $addressRepository;
    // constructor
    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    // get countries
    public function getCountries()
    {
        return $this->addressRepository->getCountries();
    }

    //get cities
    public function getCities($country_id)
    {
        return $this->addressRepository->getCities($country_id);
    }
}
