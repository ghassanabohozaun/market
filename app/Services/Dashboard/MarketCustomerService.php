<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\MarketCustomerRepository;

class MarketCustomerService
{
    protected $marketCustomerRepository;

    //__construct
    public function __construct(MarketCustomerRepository $marketCustomerRepository)
    {
        $this->marketCustomerRepository = $marketCustomerRepository;
    }

    // get customer
    public function getMarketCustomer($id)
    {
        $customer = $this->marketCustomerRepository->getMarketCustomer($id);
        if (!$customer) {
            return false;
        }
        return $customer;
    }

    // get customers
    public function getMarketCustomers($filters = [])
    {
        return $this->marketCustomerRepository->getMarketCustomers($filters);
    }

    // store customer
    public function storeMarketCustomer($data)
    {
        $customer = $this->marketCustomerRepository->storeMarketCustomer($data);
        if (!$customer) {
            return false;
        }
        return $customer;
    }

    // update customer
    public function updateMarketCustomer($data, $id)
    {
        $customer = self::getMarketCustomer($id);
        if (!$customer) {
            return false;
        }

        $customer = $this->marketCustomerRepository->updateMarketCustomer($data, $customer);
        if (!$customer) {
            return false;
        }
        return $customer;
    }

    // destroy customer
    public function destroyMarketCustomer($id)
    {
        $customer = $this->getMarketCustomer($id);

        if (!$customer) {
            return 'not_found';
        }

        // Check for restrictive relations
        if (method_exists($customer, 'checkRestrictiveRelations')) {
            $customer->checkRestrictiveRelations();
        }

        $result = $this->marketCustomerRepository->destroyMarketCustomer($customer);
        return $result ? 'success' : 'failed';
    }
}
