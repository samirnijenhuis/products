<?php
if (! function_exists('sentinel')) {
    /**
     * Calls the sentinel provider from the sentinel package.
     *
     * @return mixed
     */
    function sentinel()
    {
        return app('sentinel');
    }
}

if (! function_exists('reminder')) {
    /**
     * Calls the reminders provider from the sentinel package.
     *
     * @return mixed
     */
    function reminder()
    {
        return app('sentinel.reminders');
    }
}

if (! function_exists('socialite')) {
    /**
     * Calls the socialite provider.
     *
     * @return mixed
     */
    function socialite()
    {
        return app('Laravel\Socialite\Contracts\Factory');
    }
}
if (! function_exists('gravatar')) {
    /**
     * Calls the gravatar provider.
     *
     * @return mixed
     */
    function gravatar()
    {
        return app('gravatar');
    }
}
if (! function_exists('short_name')) {
    /**
     * Retrieves the user nick or firstname
     *
     * @return string|null
     */
    function short_name()
    {
        $user = sentinel()->getUser();
        if(is_null($user)) {
            return null;
        }
        $short_name = ($user->nickname) ? $user->nickname : $user->first_name;
        return ucfirst($short_name);
    }
}
if (! function_exists('full_name')) {
    /**
     * Retrieves the user nick or firstname
     *
     * @return string|null
     */
    function full_name()
    {
        $user = sentinel()->getUser();
        if(is_null($user)) {
            return null;
        }
        $full_name = ($user->first_name && $user->last_name) ? "{$user->first_name} {$user->last_name}" : $user->nickname;
        return ucwords($full_name);
    }
}
if (! function_exists('avatar')) {
    /**
     * Retrieves the user nick or firstname
     *
     * @return string|null
     */
    function avatar()
    {
        $user = sentinel()->getUser();
        if(is_null($user)) {
            return null;
        }

        if(! is_null($user->avatar)) {
            return $user->avatar;
        }

        return gravatar()->get($user->email);
    }
}

if (! function_exists('social_enabled')) {
    /**
     * Determines if you can use social login based on the keys in the services config file.
     *
     * @return bool
     */
    function social_enabled()
    {
        $services = collect(config('services'));

        return ! $services->only(['facebook', 'twitter', 'linkedin', 'google', 'github', 'bitbucket'])->isEmpty();
    }
}

if (! function_exists('social_providers')) {
    /**
     * Gives you a list of social providers.
     *
     * @return array
     */
    function social_providers()
    {
        $services = collect(config('services'));

        return $services->only(['facebook', 'twitter', 'linkedin', 'google', 'github', 'bitbucket'])->all();
    }
}