<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

use App\Country;
use App\Exceptions\FileNotDownloadedException;
use App\Exceptions\FileNotSavedException;

class DownloadGeonamesFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The storage disk name
     *
     * @var string
     */
    const DISK = 'data';

    /**
     * An instance of the storage disk object
     *
     * @var \Illuminate\Contracts\Filesystem\Filesystem
     */
    public $disk;

    /**
     * The base url to download the cities data from
     * 
     * @var string
     */
    public $url;

    /**
     * A country to download cities for
     * 
     * @var Country
     */
    public $country;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Country $country)
    {
        $this->country = $country;

        $this->disk = Storage::disk(static::DISK);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response =  Http::withOptions([
            'stream' => true
        ])->get($this->url());

        if ($response->failed()) {
            throw new FileNotDownloadedException($this->url());
        }

        $saved = $this->disk->put($this->path(), $response->getBody());

        if (!$saved) {
            throw new FileNotSavedException(
                $this->disk->path($this->path())
            );
        }
    }

    /**
     * The path where the downloaded file should be saved
     * 
     * @return string
     */
    private function path()
    {
        return $this->country->code . '/' . $this->fileName();
    }

    /**
     * The location of the file
     * 
     * @return string
     */
    private function url()
    {
        return config('geonames.url') . '/' . $this->filename();
    }

    /**
     * The name of the file
     * 
     * @return zip
     */
    private function filename()
    {
        return $this->country->code . '.zip';
    }
}