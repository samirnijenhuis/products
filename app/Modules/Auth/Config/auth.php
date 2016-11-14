<?php

return [

    /*
    |--------------------------------------------------------------------------
    |  Routing
    |--------------------------------------------------------------------------
    |
    | By default these are set that they work well with the Snijenhuis/Admin module,
    | if you want to use this module on it's own fee lfree to change the settings.
    | The prefix defines the prefix for the route group and the after_login
    | should be the name of the route that it will go to after logging in.
    |
    */

    'route' => [
        'prefix' => 'admin',
        'after_login' => 'admin.dashboard',
    ],

    /*
    |--------------------------------------------------------------------------
    |  Registration
    |--------------------------------------------------------------------------
    |
    | Here you may choose whether or not you want to enable user registration.
    |
    */
    'register' => [
        'enabled' => true
    ],

    /*
    |--------------------------------------------------------------------------
    |  View composers
    |--------------------------------------------------------------------------
    |
    | Here you can tell what views you want to be bound to our viewcomposer,
    | it will then automaticly bind the following variables to your view:
    | $short_name, $profile_picture
    |
    */
    'views' => [
        'admin::partials.header',
        'admin::partials.sidebar'
    ],

];
