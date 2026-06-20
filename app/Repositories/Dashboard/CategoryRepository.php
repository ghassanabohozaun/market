<?php

namespace App\Repositories\Dashboard;

use App\Models\Category;

class CategoryRepository
{
    // get category
    public function getCategory($id)
    {
        return Category::find($id);
    }

    // get categories for table
    public function getCategories($filters = [])
    {
        return Category::with('parentRelation')
            ->when(!empty($filters['search_term']), function ($query) use ($filters) {
                $query->where(function ($q) use ($filters) {
                    $q->where('name', 'like', '%' . $filters['search_term'] . '%')
                        ->orWhere('slug', 'like', '%' . $filters['search_term'] . '%');
                });
            })
            ->when(isset($filters['status']) && $filters['status'] !== '', function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->orderByDesc('created_at')
            ->select('id', 'name', 'slug', 'parent', 'status', 'icon', 'created_at')
            ->paginate(10);
    }

    // get all categories (e.g. for dropdowns)
    public function getAllCategories()
    {
        return Category::active()->select('id', 'name')->get();
    }

    // store category
    public function storeCategory($data)
    {
        return Category::create($data);
    }

    // update category
    public function updateCategory($category, $data)
    {
        return $category->update($data);
    }

    // destroy category
    public function destroyCategory($category)
    {
        return $category->delete(); // Soft delete
    }

    // change status
    public function changeStatusCategory($category, $status)
    {
        return $category->update([
            'status' => $status,
        ]);
    }
}
