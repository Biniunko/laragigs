<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
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
    public function boot()
    {
          Model::unguard();

        /*Event::listen('Illuminate\Session\Events\SessionStarted', function ($event) {
        Log::info('Session started', [
            'id' => $event->session->getId(),
            'user' => auth('web')->id(),
        ]);
    });*/
    }
}
