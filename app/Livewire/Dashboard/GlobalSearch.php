<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class GlobalSearch extends Component
{
    public $search = '';
    public $results = [];

    public function updatedSearch()
    {
        if (mb_strlen($this->search, 'UTF-8') < 2) {
            $this->results = [];
            return;
        }

        $query = mb_strtolower($this->search, 'UTF-8');
        
        $this->results = [
            'pages' => $this->searchPages($query),
            'actions' => $this->searchActions($query),
            'data' => $this->searchData($query),
        ];
    }

    private function searchPages($query)
    {
        $pages = [
            ['name' => __('navbar.countries'), 'url' => route('dashboard.addresses.countries.index'), 'icon' => 'mdi-earth'],
            ['name' => __('navbar.cities'), 'url' => route('dashboard.addresses.cities.index'), 'icon' => 'mdi-city'],
            ['name' => __('navbar.admins'), 'url' => route('dashboard.admins.index'), 'icon' => 'mdi-shield-account'],
            ['name' => __('navbar.settings'), 'url' => route('dashboard.settings.index'), 'icon' => 'mdi-cog-outline'],
        ];

        return array_values(array_filter($pages, function($page) use ($query) {
            return str_contains(mb_strtolower($page['name'], 'UTF-8'), $query);
        }));
    }

    private function searchActions($query)
    {
        $actions = [
            ['name' => __('navbar.add_country'), 'url' => route('dashboard.addresses.countries.create'), 'icon' => 'mdi-plus-circle-outline'],
            ['name' => __('navbar.add_city'), 'url' => route('dashboard.addresses.cities.create'), 'icon' => 'mdi-plus-box-outline'],
            ['name' => __('navbar.add_user'), 'url' => route('dashboard.admins.create'), 'icon' => 'mdi-account-plus-outline'],
        ];

        return array_values(array_filter($actions, function($action) use ($query) {
            return str_contains(mb_strtolower($action['name'], 'UTF-8'), $query);
        }));
    }

    private function searchData($query)
    {
        $data = [];

        // Search Countries
        $countries = \App\Models\Country::where(function($q) use ($query) {
            $q->where('name->ar', 'like', "%$query%")
              ->orWhere('name->en', 'like', "%$query%");
        })->limit(3)->get();

        foreach ($countries as $country) {
            $data[] = [
                'name' => $country->name,
                'url' => route('dashboard.addresses.countries.index', ['search' => $country->name]),
                'icon' => 'mdi-earth',
                'type' => __('navbar.country')
            ];
        }

        // Search Cities
        $cities = \App\Models\City::where(function($q) use ($query) {
            $q->where('name->ar', 'like', "%$query%")
              ->orWhere('name->en', 'like', "%$query%");
        })->limit(3)->get();

        foreach ($cities as $city) {
            $data[] = [
                'name' => $city->name,
                'url' => route('dashboard.addresses.cities.index', ['search' => $city->name]),
                'icon' => 'mdi-city',
                'type' => __('navbar.city')
            ];
        }

        return $data;
    }



    public function render()
    {
        return view('livewire.dashboard.global-search');
    }
}

