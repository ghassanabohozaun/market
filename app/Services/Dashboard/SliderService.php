<?php

namespace App\Services\Dashboard;

use App\Repositories\Dashboard\SliderRepository;
use App\Utils\ImageManagerUtils;
use Yajra\DataTables\Facades\DataTables;

class SliderService
{
    protected $sliderRepository, $imageManagerUtils;
    //__construct
    public function __construct(SliderRepository $sliderRepository, ImageManagerUtils $imageManagerUtils)
    {
        $this->sliderRepository = $sliderRepository;
        $this->imageManagerUtils = $imageManagerUtils;
    }

    // get slider
    public function getSlider($id)
    {
        $slider = $this->sliderRepository->getSlider($id);
        if (!$slider) {
            return false;
        }
        return $slider;
    }

    // get sliders
    public function getSliders($params = [])
    {
        return $this->sliderRepository->getSliders($params);
    }

    // create slider
    public function storeSlider($data)
    {
        if (array_key_exists('photo', $data) && $data['photo'] != null) {
            $photo_name = $this->imageManagerUtils->saveResizeImage($data['photo'], 'sliders', 1024, 1024);
            $data['photo'] = $photo_name;
        }

        $slider = $this->sliderRepository->create($data);
        if (!$slider) {
            return false;
        }
        return $slider;
    }

    // update slider
    public function updateSlider($data)
    {
        $slider = self::getSlider($data['id']);
        if (!$slider) {
            return false;
        }

        if (array_key_exists('photo', $data) && $data['photo'] != null) {
            if (!empty($slider->photo)) {
                $this->imageManagerUtils->removeImageFromLocal($slider->photo, 'sliders');
            }
            $photo_name = $this->imageManagerUtils->saveResizeImage($data['photo'], 'sliders', 1024, 1024);
            $data['photo'] = $photo_name;
        } else {
            $data['photo'] = $slider->photo;
        }

        $updated = $this->sliderRepository->update($slider, $data);
        if (!$updated) {
            return false;
        }
        return $slider;
    }

    // destroy slider
    public function destroySlider($id)
    {
        $slider = self::getSlider($id);
        if (!$slider) {
            return false;
        }

        if (!empty($slider->photo)) {
            $this->imageManagerUtils->removeImageFromLocal($slider->photo, 'sliders');
        }

        $result = $this->sliderRepository->destroy($slider);
        if (!$result) {
            return false;
        }
        return $result;
    }

    // update change status slider
    public function changeStatusSlider($id, $status)
    {
        $slider = self::getSlider($id);
        if (!$slider) {
            return false;
        }
        $slider = $this->sliderRepository->changeStatus($slider, $status);
        if (!$slider) {
            return false;
        }
        return $slider;
    }
}
