<?php

namespace Snijenhuis\Modules\Auth\ViewComposers;

use Illuminate\View\View;

class UserComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('short_name', short_name());
        $view->with('full_name', full_name());
        $view->with('profile_picture', avatar());
    }
}