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
        $pinecone = app(Pinecone::class);
        $openAI = app(\OpenAI\Client::class);

        Location::all()->each(function (Location $location) use ($openAI, $pinecone) {
            $embedding = $openAI
                ->embeddings()
                ->create([
                    'model' => 'text-embedding-ada-002',
                    'input' => $location->description
                ]);

            $pinecone->index('neotribal')
                ->vectors()
                ->upsert(vectors: [
                    'id' => 'locations_' . $location->id,
                    'values' => $embedding->embeddings[0]->embedding,
                    'metadata' => [
                        'id' => $location->id,
                        'title' => $location->name
                    ]
                ]);
        });

        LocationStar::all()->each(function (LocationStar $location) use ($openAI, $pinecone) {
            $embedding = $openAI
                ->embeddings()
                ->create([
                    'model' => 'text-embedding-ada-002',
                    'input' => $location->description
                ]);

            $pinecone->index('neotribal')
                ->vectors()
                ->upsert(vectors: [
                    'id' => 'locationstar_' . $location->id,
                    'values' => $embedding->embeddings[0]->embedding,
                    'metadata' => [
                        'id' => $location->id,
                        'title' => $location->name
                    ]
                ]);
        });
    }
}
