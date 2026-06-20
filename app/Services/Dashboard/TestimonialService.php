<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\TestimonialRepository;
use App\Utils\ImageManagerUtils;

class TestimonialService
{
    protected $testimonialRepository, $imageManagerUtils;

    public function __construct(TestimonialRepository $testimonialRepository, ImageManagerUtils $imageManagerUtils)
    {
        $this->testimonialRepository = $testimonialRepository;
        $this->imageManagerUtils = $imageManagerUtils;
    }

    public function getTestimonial($id)
    {
        $testimonial = $this->testimonialRepository->getTestimonial($id);
        if (!$testimonial) {
            return false;
        }
        return $testimonial;
    }

    public function getTestimonials($filters = [])
    {
        return $this->testimonialRepository->getTestimonials($filters);
    }

    public function store($data)
    {
        if (array_key_exists('image', $data) && $data['image'] != null) {
            $data['image'] = $this->imageManagerUtils->saveResizeImage($data['image'], 'testimonials', 500, 500);
        } else {
            $data['image'] = '';
        }

        return $this->testimonialRepository->storeTestimonial($data);
    }

    public function update($data)
    {
        $testimonial = $this->getTestimonial($data['id']);
        if (!$testimonial) {
            return false;
        }

        if (array_key_exists('image', $data) && $data['image'] != null) {
            if ($testimonial->image != null) {
                $this->imageManagerUtils->removeImageFromLocal($testimonial->image, 'testimonials');
            }
            $data['image'] = $this->imageManagerUtils->saveResizeImage($data['image'], 'testimonials', 500, 500);
        } else {
            $data['image'] = $testimonial->image;
        }

        $this->testimonialRepository->updateTestimonial($testimonial, $data);
        return $testimonial;
    }

    public function destroy($id)
    {
        $testimonial = $this->getTestimonial($id);

        if (!$testimonial) {
            return 'not_found';
        }

        if (!empty($testimonial->image)) {
            $this->imageManagerUtils->removeImageFromLocal($testimonial->image, 'testimonials');
        }

        $result = $this->testimonialRepository->destroyTestimonial($testimonial);
        return $result ? 'success' : 'failed';
    }

    public function changeStatus($id, $status)
    {
        $testimonial = $this->getTestimonial($id);
        if (!$testimonial) {
            return false;
        }

        $this->testimonialRepository->changeStatusTestimonial($testimonial, $status);
        $testimonial->status = $status;
        return $testimonial;
    }
}
