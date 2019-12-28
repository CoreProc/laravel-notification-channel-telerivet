<?php

namespace CoreProc\NotificationChannels\Telerivet;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class TelerivetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(TelerivetChannel::class)
            ->needs(Client::class)
            ->give(function () {
                return new Client([
                    'base_uri' => config('broadcasting.connections.telerivet.url', TelerivetChannel::DEFAULT_API_URL),
                ]);
            });
    }
}
