<?php

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

use OpenAI\Client;
use \Probots\Pinecone\Client as Pinecone;
use URL;
use OpenAI\Factory as OpenAIFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        $this->app->singleton(Pinecone::class, function (Application $app) {
            return new Pinecone(
                config('services.pinecone.api_key'),
                config('services.pinecone.environment')
            );
        });

        $this->app->singleton(Client::class, function (Application $app) {
            $factory = new OpenAIFactory();

            return $factory
                ->withApiKey(config('services.openai.api_key'))
                ->make();
        });
    }
}
