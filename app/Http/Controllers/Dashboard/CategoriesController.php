<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Services\Dashboard\CategoryService;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $filters = $request->all();
        $categories = $this->categoryService->getCategories($filters);
        $allCategories = $this->categoryService->getAllCategories();

        if ($request->ajax()) {
            return view('dashboard.categories.partials._table', compact('categories'))->render();
        }
        return view('dashboard.categories.index', compact('categories', 'allCategories'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $category = $this->categoryService->store($data);

        if (!$category) {
            return response()->json(['status' => false, 'message' => __('messages.error')], 500);
        }

        return response()->json(['status' => true, 'message' => __('messages.success'), 'data' => $category], 200);
    }



    public function update(CategoryRequest $request, string $id)
    {

        $data = $request->only(['id', 'name', 'slug', 'parent', 'status', 'icon']);

        $category = $this->categoryService->update($data);

        if (!$category) {
            return response()->json(['status' => false, 'message' => __('messages.error')], 500);
        }

        return response()->json(['status' => true, 'message' => __('messages.success'), 'data' => $category], 200);
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            try {
                $status = $this->categoryService->destroy($request->id);

                if ($status === 'success') {
                    return response()->json(['status' => true], 200);
                } elseif ($status === 'not_found') {
                    return response()->json(['status' => false, 'message' => __('general.no_record_found')], 404);
                }

                return response()->json(['status' => false, 'message' => __('messages.error')], 500);
            } catch (\App\Exceptions\DeleteRestrictionException $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 422);
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
            }
        }
    }

    public function changeStatus(Request $request)
    {
        $category = $this->categoryService->changeStatus($request->id, $request->statusSwitch);

        if (!$category) {
            return response()->json(['status' => false, 'message' => __('messages.error')], 500);
        }

        return response()->json(['status' => true, 'message' => __('messages.success'), 'data' => $category], 200);
    }

    public function getAll()
    {
        $categories = $this->categoryService->getAllCategories();
        return response()->json(['status' => true, 'data' => $categories]);
    }
}
