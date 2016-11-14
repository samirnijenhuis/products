<?php

namespace Snijenhuis\Modules\Auth\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Snijenhuis\Modules\Auth\Events\ResetPasswordEvent' => [
            'Snijenhuis\Modules\Auth\Listeners\ResetPasswordEmail',
        ],
        'Snijenhuis\Modules\Auth\Events\ActivateUserEvent' => [
            'Snijenhuis\Modules\Auth\Listeners\ActivateUserEmail',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
