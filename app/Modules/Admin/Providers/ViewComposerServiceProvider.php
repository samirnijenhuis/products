<?php

namespace Snijenhuis\Modules\Admin\Providers;

use Caffeinated\Modules\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // Using class based composers...
        view()->composer(
            ['admin::partials.header', 'admin::partials.sidebar'], 'Snijenhuis\Modules\Admin\ViewComposers\UserComposer'
        );
    }

}