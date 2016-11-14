<?php

namespace Snijenhuis\Modules\Auth\Listeners;


use Cartalyst\Sentinel\Sentinel;
use Illuminate\Mail\Mailer;
use Snijenhuis\Modules\Auth\Events\ActivateUserEvent;

class ActivateUserEmail
{

    protected $mailer;
    protected $sentinel;

    /**
     * ActivateUserEmail constructor.
     * @param Mailer $mailer
     * @param Sentinel $sentinel
     */
    public function __construct(Mailer $mailer, Sentinel $sentinel)
    {
        $this->mailer = $mailer;
        $this->sentinel = $sentinel;
    }

    public function handle(ActivateUserEvent $event)
    {
        $activation = $this->sentinel->getActivationRepository()->create($event->user);
        $url = route('auth.register.activate', $activation->code);

        $this->mailer->send('auth::emails.activation', compact('url'), function($message) use ($event){
            $message->to($event->user->email);
            $message->subject('Complete your registration.');
            $message->from(config('mail.from.address'), config('mail.from.name'));
        });
    }
}