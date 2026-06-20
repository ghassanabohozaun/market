<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CategoryRepository;
use App\Utils\ImageManagerUtils;
use Yajra\DataTables\Facades\DataTables;

class CategorySevice
{
    protected $categoryRepository, $imageManagerUtils;
    // __construct
    public function __construct(CategoryRepository $categoryRepository, ImageManagerUtils $imageManagerUtils)
    {
        $this->categoryRepository = $categoryRepository;
        $this->imageManagerUtils = $imageManagerUtils;
    }

    // get category
    public function getCategory($id)
    {
        $category = $this->categoryRepository->getCategory($id);
        if (!$category) {
            return false;
        }

        return $category;
    }

    // get categories
    public function getCategories()
    {
        return $this->categoryRepository->getCategories();
    }

    // get all categories without pagination
    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }



    // store category
    public function storeCategory($data)
    {
        // upload logo
        if (array_key_exists('icon', $data) && $data['icon'] != null) {
            // add new icon
            $data['icon'] = $this->imageManagerUtils->saveResizeImage($data['icon'], 'categories', 500, 500);
        }

        //slug
        $data['slug'] = [
            'ar' => slug($data['name']['ar']),
            'en' => slug($data['name']['en']),
        ];

        $category = $this->categoryRepository->storeCategory($data);
        if (!$category) {
            return false;
        }

        return $category;
    }

    // update category
    public function updateCategory($data)
    {
        $category = $this->categoryRepository->getCategory($data['id']);

        if (array_key_exists('icon', $data) && $data['icon'] != null) {
            // delete old icon
            $this->imageManagerUtils->removeImageFromLocal($category->icon, 'categories');
            // add new icon
            $data['icon'] = $this->imageManagerUtils->saveResizeImage($data['icon'], 'categories', 500, 500);
        }

        //slug
        $data['slug'] = [
            'ar' => slug($data['name']['ar']),
            'en' => slug($data['name']['en']),
        ];
        $category = $this->categoryRepository->updateCategory($category, $data);

        if (!$category) {
            return false;
        }
        return $category;
    }

    // destroy category
    public function destroyCategory($id)
    {
        $category = $this->categoryRepository->getCategory($id);

        if ($category['icon'] != null) {
            $this->imageManagerUtils->removeImageFromLocal($category->icon, 'categories');
        }

        $category = $this->categoryRepository->destroyCategory($category);
        if (!$category) {
            return false;
        }

        return $category;
    }

    // change status category
    public function changeStatusCategory($id, $status)
    {
        $category = $this->categoryRepository->getCategory($id);

        $update = $this->categoryRepository->changeStatusCategory($category, $status);
        if (!$update) {
            return false;
        }
        return $category;
    }
}
