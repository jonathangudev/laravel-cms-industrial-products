<?php

namespace App\Company;

use App\Company;
use App\User as AppUser;

class User extends AppUser
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_user';

    /**
     * Get the company that owns the user.
     *
     * @return App\Company
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
