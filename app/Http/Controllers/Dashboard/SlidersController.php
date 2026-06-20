<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SliderRequest;
use App\Models\Slider;
use App\Services\Dashboard\SliderService;
use Illuminate\Http\Request;

class SlidersController extends Controller
{
    protected $sliderService;
    //__construct
    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }
    // index
    public function index(Request $request)
    {
        $title = __('sliders.sliders');
        $sliders = $this->sliderService->getSliders($request->all());

        if ($request->ajax()) {
            return view('dashboard.sliders.partials._table', compact('sliders'))->render();
        }

        return view('dashboard.sliders.index', compact('title', 'sliders'));
    }

    // create
    public function create()
    {
        $title = __('sliders.create_new_slider');
        return view('dashboard.sliders.create', compact('title'));
    }

    // store
    public function store(SliderRequest $request)
    {
        $data = $request->validated();
        $slider = $this->sliderService->storeSlider($data);
        if (!$slider) {
            return response()->json(['status' => false, 'message' => __('general.error_message')], 500);
        }

        return response()->json(['status' => true, 'message' => __('general.add_success_message')]);
    }

    // show
    public function show(Slider $slider)
    {
        //
    }

    // edit
    public function edit($id)
    {
        $slider = $this->sliderService->getSlider($id);
        if (!$slider) {
            flash()->error(__('general.no_record_found'));
            return redirect()->route('dashboard.sliders.index');
        }
        $title = __('sliders.update_slider');
        return view('dashboard.sliders.edit', compact('slider', 'title'));
    }

    // update
    public function update(SliderRequest $request, $id)
    {
        $data = $request->validated();
        $data['id'] = $id;
        $slider = $this->sliderService->updateSlider($data);
        if (!$slider) {
            return response()->json(['status' => false, 'message' => __('general.error_message')], 500);
        }

        return response()->json(['status' => true, 'message' => __('general.update_success_message')]);
    }

    // destroy
    public function destroy(Request $request)
    {
        $slider = $this->sliderService->destroySlider($request->id);
        if (!$slider) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true], 200);
    }

    // changeStatus
    public function changeStatus(Request $request)
    {
        $slider = $this->sliderService->changeStatusSlider($request->id, $request->statusSwitch);
        if (!$slider) {
            return response()->json(['status' => false], 500);
        }
        return response()->json(['status' => true, 'data' => $slider], 200);
    }
}
