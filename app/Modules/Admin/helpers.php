<?php

if (! function_exists('debug')) {
    /**
     * Super short way of getting the debug status
     *
     * @return boolean
     */
    function debug()
    {
        return config('app.debug');
    }
}