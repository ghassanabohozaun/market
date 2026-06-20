<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class SliderResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'details' => $this->details,
            'url' => $this->url,
            'details_status' => $this->details_status ? 1 : 0,
            'button_status' => $this->button_status ? 1 : 0,
            'status' => $this->status ? 1 : 0,
            'photo' => $this->getImageUrl($this->photo, 'sliders'),
        ];
    }
}
