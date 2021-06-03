<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\LocationFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\LocationResource;
use App\Models\Place;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;

class PlaceLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Filters\PlaceFilter  $filter
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index(LocationFilter $filter, int $id)
    {
        if (! Place::where('geoname_id', $id)->exists()) {
            throw (new ModelNotFoundException())->setModel(Country::class);
        }

        $location = $filter
            ->applyScope('byPlace', Arr::wrap($id))
            ->getBuilder()
            ->first();

        return LocationResource::make($location);
    }
}
