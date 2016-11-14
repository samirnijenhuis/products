<?php

namespace Snijenhuis\Modules\Auth\Events;

use Illuminate\Queue\SerializesModels;

class ActivateUserEvent
{
    use SerializesModels;
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}