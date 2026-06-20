<?php

namespace App\Services\Api;

use App\Models\Category;
use App\Repositories\Api\GlobalRepository;

class GlobalService
{
    protected $globalRepository;
    public function __construct(GlobalRepository $globalRepository)
    {
        $this->globalRepository = $globalRepository;
    }

    // get settings
    public function getSettings(){
        return $this->globalRepository->getSettings();
    }

    // get categories
    public function getCategories($limit = null)
    {
        return $this->globalRepository->getCategories($limit);
    }

    // get sliders
    public function getSliders($limit = null)
    {
        return $this->globalRepository->getSliders($limit);
    }

    // get pages
    public function getPages() {
        return $this->globalRepository->getPages();
    }
}
