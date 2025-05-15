<?php

namespace App\Providers;

use App\Events\VideoEvent;
use App\Listener\SendVideoCreatedNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        VideoEvent::class => [
            SendVideoCreatedNotification::class,
        ],
    ];
    public function boot()
    {
        parent::boot();
    }
}
