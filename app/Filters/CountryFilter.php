<?php

namespace App\Filters;

use App\Models\Country;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedInclude;

class CountryFilter extends Filter
{
    /**
     * Return the model classname to be filtered.
     *
     * @return string
     */
    public function modelClass(): string
    {
        return Country::class;
    }

    /**
     * The attributes we can use to filter.
     *
     * @return array
     */
    public function getAllowedFilters() : array
    {
        return [
            AllowedFilter::exact('name'),
            AllowedFilter::exact('iso3166_alpha2'),
            AllowedFilter::exact('iso3166_alpha3'),
            AllowedFilter::exact('iso3166_numeric'),
            AllowedFilter::exact('population'),
            AllowedFilter::exact('area'),
            AllowedFilter::exact('phone_code'),
            AllowedFilter::scope('area_gt'),
            AllowedFilter::scope('area_gte'),
            AllowedFilter::scope('area_lt'),
            AllowedFilter::scope('area_lte'),
            AllowedFilter::scope('area_between'),
            AllowedFilter::scope('population_gt'),
            AllowedFilter::scope('population_gte'),
            AllowedFilter::scope('population_lt'),
            AllowedFilter::scope('population_lte'),
            AllowedFilter::scope('population_between'),
            AllowedFilter::scope('neighbour_of'),
        ];
    }

    /**
     * The relations that we can include.
     *
     * @return array
     */
    public function getAllowedIncludes() : array
    {
        return [
            AllowedInclude::relationship('continent'),
            AllowedInclude::relationship('timeZones'),
            AllowedInclude::relationship('flag'),
            AllowedInclude::relationship('neighbours'),
            AllowedInclude::relationship('languages'),
        ];
    }
}
