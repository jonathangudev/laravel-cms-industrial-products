<?php

namespace App\Listeners\Logs;

use App\Events\UserLoggedIn;
use App\Logs\UserLogin;

class LogUserLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        $user_id = $event->user->id;

        $logEntry = new UserLogin;

        $logEntry->save();
    }
}
