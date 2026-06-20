<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends BaseResource
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
            'site_name' => $this->site_name,
            'address' => $this->address,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'phone' => $this->phone,
            'mobile' => $this->mobile,
            'whatsapp' => $this->whatsapp,
            'email' => $this->email,
            'email_support' => $this->email_support,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instegram' => $this->instegram,
            'youtube' => $this->youtube,
            'promation_video_url' => $this->promation_video_url,
            'logo' => $this->getImageUrl($this->logo, 'settings'),
            'favicon' => $this->getImageUrl($this->favicon, 'settings'),
        ];
    }
}
