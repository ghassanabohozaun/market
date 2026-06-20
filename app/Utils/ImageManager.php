<?php

namespace App\Utils;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ImageManager
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // upload images
    public function uploadImages($images, $modal, $disk)
    {
        foreach ($images as $image) {
            $file_name = $this->generateImageName($image);
            $this->storeImageInLocal($image, '/', $file_name, $disk);
            $modal->images()->create([
                'file_name' => $file_name,
            ]);
        }
    }

    // upload single image
    public function uploadSingleImage($path, $image, $disk)
    {
        $file_name = $this->generateImageName($image);
        self::storeImageInLocal($image, $path, $file_name, $disk);
        return $file_name;
    }

    // generate image name
    public function generateImageName($image)
    {
        $file_name = Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
        return $file_name;
    }

    // store image in local
    private function storeImageInLocal($image, $path, $file_name, $disk)
    {
        $image->storeAs($path, $file_name, ['disk' => $disk]);
    }

    public function removeImageFromLocal($image, $disk)
    {
        $public_path = public_path('uploads\\' . $disk . '\\' . $image);

        if (File::exists($public_path)) {
            File::delete($public_path);
        }
    }
}
