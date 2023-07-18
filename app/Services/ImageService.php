<?php

namespace App\Services;

use App\Models\Joblisting;
use Image;
use Illuminate\Http\Request;

class ImageService
{
    public function updateImage(Joblisting $model, Request $request)
    {
        // Make sure the request has a 'company_logo' file. Otherwise we return early
        if (!$request->hasFile('company_logo')) {
            return $model;
        }

        $image = Image::make($request->file('company_logo'));

        if (!empty($model->company_logo)) {
            $currentImage = public_path() . $model->company_logo;

            // If file exists and not the default logo
            if (file_exists($currentImage) && $currentImage != public_path() . "/images/nologo.svg") {
                // Delete it.
                unlink($currentImage);
            }
        }

        // Otherwise create it
        $file = $request->file('company_logo');
        $extension = $file->getClientOriginalExtension();
        $name = time() . '.' . $extension;

        // Save the new file by its name into the public/images directory
        $image->save(public_path() . '/images/' . $name);

        // Update the model's company_logo attribute
        $model->company_logo = '/images/' . $name;

        return $model;
    }
}
