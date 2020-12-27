<?php

namespace App\Imports;

use App\Imports\Concerns\GeonamesImportable;
use App\Imports\Iterators\GeonamesFileIterator;
use App\Language;
use Carbon\Carbon;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Str;

class LanguagesImport extends GeonamesFileIterator implements GeonamesImportable
{
    /**
     * Decides whether to skip a row or not
     *
     * @param array  $row
     * @param boolean
     */
    public function skip(array $row)
    {
        return Str::is($row[0], 'ISO 639-3');
    }

    /**
     * Import the required data into the database
     *
     * @return void
     */
    public function import()
    {
        $this
            ->iterable()
            ->chunk(1000)
            ->map(function (LazyCollection $chunk) {
                return $chunk->map(function (array $row) {
                    $timestamp = Carbon::now()->toDateTimeString();

                    return [
                        'iso639_1' => $row[2],
                        'iso639_2' => $row[1],
                        'iso639_3' => $row[0],
                        'language_name' => $row[3],
                        'created_at' => $timestamp,
                        'updated_at' => $timestamp,
                    ];
                });
            })->each(function ($data) {
                Language::insert($data->all());
            });
    }
}
