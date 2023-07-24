<?php

namespace App\Services;

use App\Models\Company;
use Image;
use Illuminate\Http\Request;

class ImageService
{
    public function updateImage(Company $model, Request $request)
    {
        // Make sure the request has a 'logo' file. Otherwise we return early
        if (!$request->hasFile('logo')) {
            return $model;
        }

        $image = Image::make($request->file('logo'));

        if (!empty($model->logo)) {
            $currentImage = public_path() . $model->logo;

            // If file exists and not the default logo
            if (file_exists($currentImage) && $currentImage != public_path() . "/images/nologo.jpg") {
                // Delete it.
                unlink($currentImage);
            }
        }

        // Otherwise create it
        $file = $request->file('logo');
        $extension = $file->getClientOriginalExtension();
        $name = time() . '.' . $extension;

        // Save the new file by its name into the public/images directory
        $image->save(public_path() . '/images/' . $name);

        // Update the model's logo attribute
        $model->logo = '/images/' . $name;

        return $model;
    }
}
