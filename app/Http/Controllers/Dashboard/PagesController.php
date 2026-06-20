<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PageRequest;
use App\Services\Dashboard\PageService;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    protected $pageService;

    // __construct
    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    // index
    public function index(Request $request)
    {
        $title = __('pages.pages');
        $pages = $this->pageService->getPagesPaginated($request->all(), 10);

        if ($request->ajax()) {
            return view('dashboard.pages.partials._table', compact('pages'))->render();
        }

        return view('dashboard.pages.index', compact('title', 'pages'));
    }


    // create
    public function create()
    {
        $title = __('pages.create_new_page');
        return view('dashboard.pages.create', compact('title'));
    }

    // store
    public function store(PageRequest $request)
    {
        $data = $request->only(['title', 'details', 'photo', 'status']);
        $page = $this->pageService->store($data);
        if (!$page) {
            return response()->json(['status' => false, 'message' => __('general.error_message')], 500);
        }
        return response()->json(['status' => true, 'message' => __('general.add_success_message')]);
    }

    // show
    public function show(string $id)
    {
        //
    }

    // edit
    public function edit(string $id)
    {
        $page = $this->pageService->getPage($id);
        if (!$page) {
            flash()->error(__('general.no_record_found'));
            return redirect()->route('dashboard.pages.index');
        }
        $title = __('pages.update_page');
        return view('dashboard.pages.edit', compact('title', 'page'));
    }

    // update
    public function update(PageRequest $request, string $id)
    {
        $data = $request->only(['id', 'title', 'details', 'photo', 'status']);
        $page = $this->pageService->update($data);
        if (!$page) {
            return response()->json(['status' => false, 'message' => __('general.error_message')], 500);
        }
        return response()->json(['status' => true, 'message' => __('general.update_success_message')]);
    }

    // destroy
    public function destroy(Request $request)
    {
        $id = $request->id;
        $page = $this->pageService->destroy($id);
        if (!$page) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true], 200);
    }

    // change status
    public function changeStatus(Request $request)
    {
        $page = $this->pageService->changeStatus($request->id, $request->statusSwitch);
        if (!$page) {
            return response()->json(['status' => false], 500);
        }
        return response()->json([
            'status' => true,
            'data' => $page
        ], 200);
    }

    // delete photo

}
