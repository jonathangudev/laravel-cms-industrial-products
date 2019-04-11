<?php

namespace App\Logs;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserLogin extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'logs_user_logins';
}
