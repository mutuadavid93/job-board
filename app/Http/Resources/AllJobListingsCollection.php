<?php

namespace App\Http\Resources;

use JsonSerializable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/*
|--------------------------------------------------------------------------
| Resource Collection 
|--------------------------------------------------------------------------
|
| TIP: The structure of the collection mirrors the bas Model relationship
| structure e.g. JobListing Model. All those methods become keys.
|
*/


class AllJobListingsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array|JsonSerializable
    {
        // NOTE: $item : references the base Model e.g. JobListing being passed in below context
        $data =  [
            "data" => $this->collection->map(function ($item) {
                return [
                    // Base fields
                    'id' => $item->id,
                    "title" => $item->title,
                    "description" => $item->description,
                    "employment_type" => $item->employment_type,
                    "salary" => $item->salary,
                    "experience_level" => $item->experience_level,
                    "created_at" => $item->created_at->diffForHumans(),
                    // 2w or 1hr
                    "updated_at" => $item->updated_at->format('M D Y'),

                    // NOTE: we don't loop belongsTo relationship
                    "company" => $item->company->only(["id", "description", "email", "address", "logo"]),
                    "category" => $item->category->only(["name", "slug"]),

                    "locations" => $item->locations,//->map(function ($location) {
                    //     return [
                    //         "id" => $location->id,
                    //         "name" => $location->name,
                    //         "country" => $location->country,
                    //         "city" => $location->city,

                    //         // HINT:
                    //         // The company information is already accessible through $item->company above.
                    //         // Thus it's redundant.
                    //     ];
                    // }),
                    // "enhancements" => $item->enhancements->map(function ($enhancement) {
                    //     // return $enhancement->only(["id", "type", "expiration_date"]);
        
                    //     // HINT:
                    //     // Since we are already working within the context of a JobListing model ($item), you don't 
                    //     // need to include redundant information about the JobListing itself 
                    //     // in the enhancements mapping function.
                    //     return [
                    //         "id" => $enhancement->id,
                    //         "type" => $enhancement->type,
                    //         "expiration_date" => $enhancement->expiration_date,

                    //         // Add other fields specific to the Enhancement model
                    //         // ...
                    //     ];
                    // })
                ];

            }),
            'meta' => [
                'total' => $this->collection->count(),
            ],
        ];
        dd($data);
    }
}
