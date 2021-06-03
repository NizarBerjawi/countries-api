<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'latitude', 'longitude',
    ];

    /**
     * Get the owning locationable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function locationable()
    {
        return $this->morphTo();
    }

    /**
     * Get locations by place.
     *
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param int $geonameId
     * @return \Illuminate\Database\Eloquent\Builder  $query
     */
    public function scopeByPlace(Builder $query, int $id)
    {
        return $query
            ->where('locationable_id', $id)
            ->where('locationable_type', Place::class);
    }
}
