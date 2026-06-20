<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\CategoryRepository;
use App\Utils\ImageManagerUtils;

class CategoryService
{
    protected $categoryRepository, $imageManagerUtils;

    public function __construct(CategoryRepository $categoryRepository, ImageManagerUtils $imageManagerUtils)
    {
        $this->categoryRepository = $categoryRepository;
        $this->imageManagerUtils = $imageManagerUtils;
    }

    public function getCategory($id)
    {
        $category = $this->categoryRepository->getCategory($id);
        if (!$category) {
            return false;
        }
        return $category;
    }

    public function getCategories($filters = [])
    {
        return $this->categoryRepository->getCategories($filters);
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function store($data)
    {
        if (array_key_exists('icon', $data) && $data['icon'] != null) {
            $data['icon'] = $this->imageManagerUtils->saveResizeImage($data['icon'], 'categories', 500, 500);
        } else {
            $data['icon'] = '';
        }

        return $this->categoryRepository->storeCategory($data);
    }

    public function update($data)
    {
        $category = $this->getCategory($data['id']);
        if (!$category) {
            return false;
        }

        if (array_key_exists('icon', $data) && $data['icon'] != null) {
            if ($category->icon != null) {
                $this->imageManagerUtils->removeImageFromLocal($category->icon, 'categories');
            }
            $data['icon'] = $this->imageManagerUtils->saveResizeImage($data['icon'], 'categories', 500, 500);
        } else {
            // Keep the old icon if no new one is uploaded
            $data['icon'] = $category->icon;
        }

        $this->categoryRepository->updateCategory($category, $data);
        return $category;
    }

    public function destroy($id)
    {
        $category = $this->getCategory($id);

        if (!$category) {
            return 'not_found';
        }

        // Check for restrictive relations (throws DeleteRestrictionException if blocked)
        if (method_exists($category, 'checkRestrictiveRelations')) {
            $category->checkRestrictiveRelations();
        }

        // Delete icon if exists
        if (!empty($category->icon)) {
            $this->imageManagerUtils->removeImageFromLocal($category->icon, 'categories');
        }

        $result = $this->categoryRepository->destroyCategory($category);
        return $result ? 'success' : 'failed';
    }

    public function changeStatus($id, $status)
    {
        $category = $this->getCategory($id);
        if (!$category) {
            return false;
        }

        $this->categoryRepository->changeStatusCategory($category, $status);
        $category->status = $status;
        return $category;
    }
}
