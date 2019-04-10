<?php

namespace App\Listeners\Logs;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use App\Logs\UserLogin;

class LogUserLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
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
        $ip_address = $this->request->ip();

        $logEntry = new UserLogin;
        $logEntry->user_id = $user_id;
        $logEntry->ip_address = $ip_address;

        $logEntry->save();
    }
}
