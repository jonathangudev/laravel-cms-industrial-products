<?php

namespace App\Listeners\Logs;

use Illuminate\Auth\Events\Login;
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
    public function handle(Login $event)
    {
        $user_id = $event->user->id;
        $ip_address = $event->user->ip_address;

        $logEntry = new UserLogin;
        $logEntry->user_id = $user_id;

        $logEntry->save();
    }
}
