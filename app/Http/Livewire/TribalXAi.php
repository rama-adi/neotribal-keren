<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use OpenAI\Client;

class TribalXAi extends Component
{
    public $history = [];

    public $input = "";
    public $currentResponse = "Ready to ask a question?";

    public function ask()
    {
        $this->history = [];

        $this->history[] = [
            'role' => 'system',
            'content' => str(view('prompts.tribal-x.starting')->render())
                ->replace("\n", " ")
        ];

        $openAI = app(Client::class);
        $pinecone = app(\Probots\Pinecone\Client::class);
        $embedding = $openAI
            ->embeddings()
            ->create([
                'model' => 'text-embedding-ada-002',
                'input' => $this->input
            ]);

        $vectorFetch = $pinecone
            ->index('neotribal')
            ->vectors()
            ->query(
                vector: $embedding->embeddings[0]->embedding,
                topK: 2
            );

        $responses = [];

        foreach ($vectorFetch->json('matches') as $match) {
            [$model, $id] = explode('-', $match['id']);

            $model = match ($model) {
                'location' => \App\Models\Location::find($id),
                'locationstar' => \App\Models\LocationStar::find($id),
            };

            $responses[] = $model
                ->find((int)$id)
                ->description;
        }


        $this->history[] = [
            'role' => 'user',
            'content' => implode(" ", [
                'Here is the data from NeoTribal: ' . implode(" ", $responses)
            ])
        ];

        $this->history[] = [
            'role' => 'user',
            'content' => str(view('prompts.tribal-x.rules')->render())
                ->replace("\n", " ")
        ];

        $this->history[] = [
            'role' => 'user',
            'content' => $this->input
        ];


        $response = $openAI->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $this->history
        ]);


        $this->currentResponse = $response->choices[0]->message->content;
        $this->input = '';
    }

    public function render()
    {
        return view('livewire.tribal-x-ai');
    }
}
