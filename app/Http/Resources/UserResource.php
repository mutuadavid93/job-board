<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    // Disable the wrapping of the outermost resource,
    
    // TIP: Unwrapping inside UserResource is better than doing it inside AppServiceProvider
    // which unwraps all future resources.
    public function __construct($resource)
    {
        self::withoutWrapping();
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "roles" => $this->getRoleNames(),
            "permissions" => $this->getPermissionNames(),
        ];
    }
}
