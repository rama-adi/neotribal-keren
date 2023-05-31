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

class IngestToPineconeChunk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private Location | LocationStar $model, private string $idPrefix)
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

        $embedding = $openAI
            ->embeddings()
            ->create([
                'model' => 'text-embedding-ada-002',
                'input' => $this->model->description
            ]);

        $pinecone->index('neotribal')
            ->vectors()
            ->upsert(vectors: [
                'id' => $this->idPrefix . '-' . $this->model->id,
                'values' => $embedding->embeddings[0]->embedding,
                'metadata' => [
                    'id' => $this->model->id,
                    'title' => $this->model->name
                ]
            ]);
    }
}
