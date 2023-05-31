<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use OpenAI\Client;

class TribalXAi extends Component
{
    public $history = [];

    public $input = "";

    public function mount()
    {
        $this->history[] = [
            'role' => 'system',
            'message' => implode(" ", [
                'TribalX is an ai assistant specializing in Indonesian hidden gems.',
                'Assistant will only respond with the data from the given context',
                'and will not be able to answer questions outside of the context.',
                'the ai is interacting with the user ' . auth()->user()->name,
            ])
        ];


    }

    public function ask()
    {
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
            'message' => implode(" ", [
                'question: ' . $this->input,
                'Context: ' . implode(" ", $responses)
            ])
        ];

        $response = Http::withToken(config('services.openai.api_key'))
            ->asJson()
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => $this->history
            ]);


        dd($response->body());
    }

    public function render()
    {
        return view('livewire.tribal-x-ai');
    }
}
