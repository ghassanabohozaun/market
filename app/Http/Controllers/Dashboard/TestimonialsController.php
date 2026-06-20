<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TestimonialRequest;
use App\Services\Dashboard\TestimonialService;
use Illuminate\Http\Request;

class TestimonialsController extends Controller
{
    protected $testimonialService;

    public function __construct(TestimonialService $testimonialService)
    {
        $this->testimonialService = $testimonialService;
    }

    public function index(Request $request)
    {
        $filters = $request->all();
        $testimonials = $this->testimonialService->getTestimonials($filters);

        if ($request->ajax()) {
            return view('dashboard.testimonials.partials._table', compact('testimonials'))->render();
        }
        return view('dashboard.testimonials.index', compact('testimonials'));
    }

    public function store(TestimonialRequest $request)
    {
        $data = $request->validated();
        $testimonial = $this->testimonialService->store($data);

        if (!$testimonial) {
            return response()->json(['status' => false, 'message' => __('messages.error')], 500);
        }

        return response()->json(['status' => true, 'message' => __('messages.success'), 'data' => $testimonial], 200);
    }

    public function update(TestimonialRequest $request, string $id)
    {
        $data = $request->validated();
        $data['id'] = $id;

        $testimonial = $this->testimonialService->update($data);

        if (!$testimonial) {
            return response()->json(['status' => false, 'message' => __('messages.error')], 500);
        }

        return response()->json(['status' => true, 'message' => __('messages.success'), 'data' => $testimonial], 200);
    }

    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            try {
                $status = $this->testimonialService->destroy($request->id);

                if ($status === 'success') {
                    return response()->json(['status' => true], 200);
                } elseif ($status === 'not_found') {
                    return response()->json(['status' => false, 'message' => __('general.no_record_found')], 404);
                }

                return response()->json(['status' => false, 'message' => __('messages.error')], 500);
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
            }
        }
    }

    public function changeStatus(Request $request)
    {
        $testimonial = $this->testimonialService->changeStatus($request->id, $request->statusSwitch);

        if (!$testimonial) {
            return response()->json(['status' => false, 'message' => __('messages.error')], 500);
        }

        return response()->json(['status' => true, 'message' => __('messages.success'), 'data' => $testimonial], 200);
    }
}