<?php

namespace Snijenhuis\Modules\Auth\Listeners;


use Illuminate\Mail\Mailer;
use Snijenhuis\Modules\Auth\Events\ResetPasswordEvent;

class ResetPasswordEmail
{

    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(ResetPasswordEvent $event)
    {
        $url = route('auth.password.create.get', ['code' => $event->reminder->code, 'id' => $event->user->id]);

        $this->mailer->send('auth::emails.password_reset', compact('url'), function($message) use ($event) {
            $message->to($event->user->email);
            $message->subject('Reset your password');
            $message->from(config('mail.from.address'), config('mail.from.name'));
        });
    }
}