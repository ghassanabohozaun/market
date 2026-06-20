<?php

namespace App\Repositories\Dashboard;

use App\Models\MarketCustomer;

class MarketCustomerRepository
{
    // get customer
    public function getMarketCustomer($id)
    {
        return MarketCustomer::find($id);
    }

    // get customers
    public function getMarketCustomers($filters = [])
    {
        return MarketCustomer::withCount(['transactions'])
            ->when(!empty($filters['search_term']), function ($query) use ($filters) {
                $searchTerm = mb_strtolower($filters['search_term'], 'UTF-8');
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('phone', 'like', '%' . $searchTerm . '%');
                });
            })
            ->orderByDesc('id')
            ->paginate(10);
    }

    // store customer
    public function storeMarketCustomer($data)
    {
        return MarketCustomer::create($data);
    }

    // update customer
    public function updateMarketCustomer($data, $customer)
    {
        return $customer->update($data);
    }

    // destory customer
    public function destroyMarketCustomer($customer)
    {
        return $customer->delete();
    }
}
