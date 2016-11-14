<?php

namespace Snijenhuis\Modules\Admin\ViewComposers;

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
        $view->with('short_name', 'John');
        $view->with('full_name', 'John Doe');
        $view->with('profile_picture', '/assets/modules/admin/dist/img/avatar.png');
    }
}