<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'         => $this->name,
            'population'   => $this->population,
            'elevation'    => $this->elevation,
            'feature_code' => FeatureCodeResource::make($this->whenLoaded('featureCode')),
            'country'      => CountryResource::make($this->whenLoaded('country')),
            'location'     => LocationResource::make($this->whenLoaded('location'))
        ];
    }
}
