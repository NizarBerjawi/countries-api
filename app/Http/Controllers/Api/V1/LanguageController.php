<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\LanguageFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\LanguageResource;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Filters\LanguageFilter  $filter
     * @return \Illuminate\Http\Response
     */
    public function index(LanguageFilter $filter)
    {
        $languages = $filter->getPaginator();

        return LanguageResource::collection($languages);
    }
}