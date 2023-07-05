<?php

namespace App\Services;

use Image;
use Illuminate\Http\Request;

class ImageService
{
    public function updateImage($imagePath, Request $request)
    {
        $image = Image::make($request->file('company_logo'));

        // If file exists, delete it
        if (!empty($imagePath)) {
            $currentImage = public_path() . $imagePath;

            if (file_exists($currentImage) && $currentImage != public_path() . '/images/nologo.svg') {
                unlink($currentImage);
            }
        }

        // Store file in folder
        $extension = $request->file('company_logo')->getClientOriginalExtension();
        $name = time() . '.' . $extension;
        // crop image
        $image->crop(130, 130, 25, 25);
        $image->save(public_path('images/' . $name));

        // Save URL reference in database
        return '/images/' . $name;
    }
}
