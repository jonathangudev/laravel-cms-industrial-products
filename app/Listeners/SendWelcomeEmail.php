<?php

namespace App\Listeners;

class SendWelcomeEmail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // if ($event->user instanceof MustVerifyEmail && !$event->user->hasVerifiedEmail()) {
        $event->user->sendWelcomeEmail();
        // }
    }
}
