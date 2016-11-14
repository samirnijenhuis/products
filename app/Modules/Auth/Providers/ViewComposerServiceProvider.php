<?php

namespace Snijenhuis\Modules\Auth\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // Using class based composers...
        view()->composer(
            config('snijenhuis.auth.views'), 'Snijenhuis\Modules\Auth\ViewComposers\UserComposer'
        );
    }

}