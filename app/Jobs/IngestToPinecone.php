<?php

namespace App\Jobs;

use App\Models\Location;
use App\Models\LocationStar;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Probots\Pinecone\Client as Pinecone;

class IngestToPinecone implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Location::all()->each(function (Location $location) {
            IngestToPineconeChunk::dispatch(
                $location,
                'location'
            );
        });

        LocationStar::all()->each(function (LocationStar $location) {
            IngestToPineconeChunk::dispatch(
                $location,
                'locationstar'
            );
        });
    }
}
