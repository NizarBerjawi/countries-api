<?php

namespace App\Imports;

use App\Imports\Concerns\GeonamesImportable;
use App\Imports\Iterators\GeonamesFileIterator;
use App\Models\Language;
use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;

class LanguagesImport extends GeonamesFileIterator implements GeonamesImportable
{
    /**
     * Import the required data into the database.
     *
     * @return void
     */
    public function import()
    {
        $this
            ->iterable()
            ->skip(1)
            ->chunk(1000)
            ->each(function (LazyCollection $chunk) {
                $languages = Collection::make();

                foreach ($chunk as $item) {
                    $language = [
                        'iso639_1'   => $item[2],
                        'iso639_2'   => $item[1],
                        'iso639_3'   => $item[0],
                        'name'       => $item[3],
                    ];

                    $languages->push($language);
                }

                Language::insert($languages->all());
            });
    }
}
