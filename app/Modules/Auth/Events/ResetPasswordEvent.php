<?php

namespace Snijenhuis\Modules\Auth\Events;

use Illuminate\Queue\SerializesModels;

class ResetPasswordEvent
{
    use SerializesModels;
    public $user;
    public $reminder;

    public function __construct($user, $reminder)
    {
        $this->user = $user;
        $this->reminder = $reminder;
    }
}