<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TagRequest;
use App\Services\Dashboard\TagService;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    protected $tagService;
    
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index(Request $request)
    {
        $filters = $request->all();
        $tags = $this->tagService->getTags($filters);
        
        if ($request->ajax()) {
            return view('dashboard.tags.partials._table', compact('tags'))->render();
        }
        
        return view('dashboard.tags.index', compact('tags'));
    }

    public function getAll()
    {
        return response()->json(['status' => true, 'data' => $this->tagService->getAll()]);
    }

    public function store(TagRequest $request)
    {
        $data = $request->except(['_token', '_method']);
        $tag = $this->tagService->store($data);
        
        if (!$tag) {
            return response()->json(['status' => false], 500);
        }

        return response()->json(['status' => true, 'data' => $tag], 200);
    }

    public function update(TagRequest $request, string $id)
    {
        $data = $request->except(['_token', '_method']);
        $data['id'] = $id;

        $tag = $this->tagService->update($data);
        
        if (!$tag) {
            return response()->json(['status' => false], 500);
        }

        return response()->json(['status' => true, 'data' => $tag], 200);
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            try {
                $status = $this->tagService->destroy($request->id);
                if ($status === 'success') {
                    return response()->json(['status' => true, 'message' => __('messages.success')], 200);
                } elseif ($status === 'not_found') {
                    return response()->json(['status' => false, 'message' => __('general.no_record_found')], 404);
                }
                return response()->json(['status' => false, 'message' => __('messages.error')], 500);
            } catch (\App\Exceptions\DeleteRestrictionException $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 422);
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => __('messages.error')], 500);
            }
        }
    }

    public function changeStatus(Request $request)
    {
        $tag = $this->tagService->changeStatus($request->id, $request->statusSwitch);
        
        if (!$tag) {
            return response()->json(['status' => false, 'message' => __('messages.error')], 500);
        }

        return response()->json(['status' => true, 'message' => __('messages.success'), 'data' => $tag], 200);
    }
}
