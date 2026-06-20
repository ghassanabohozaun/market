<?php

namespace App\Repositories\Dashboard;

use App\Models\Slider;

class SliderRepository
{
    // get slider
    public function getSlider($id)
    {
        return Slider::find($id);
    }

    // get sliders
    public function getSliders($params = [])
    {
        $query = Slider::query()->latest();

        if (isset($params['search_term']) && !empty($params['search_term'])) {
            $searchTerm = $params['search_term'];
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title->ar', 'like', '%' . $searchTerm . '%')
                    ->orWhere('title->en', 'like', '%' . $searchTerm . '%');
            });
        }

        return $query->paginate(10);
    }

    // create slider
    public function create($data)
    {
        return Slider::create($data);
    }

    // update slider
    public function update($slider, $data)
    {
        return $slider->update($data);
    }

    // destroy slider
    public function destroy($slider)
    {
        return $slider->forceDelete();
    }

    public function changeStatus($slider, $status)
    {
        $slider->update([
            'status' => $status,
        ]);
        return $slider;
    }
}
