<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'iso3166_alpha2',
        'iso3166_alpha3',
        'iso3166_numeric', 
        'population',
        'area',
        'phone_code',
        'flag'
    ];
}
