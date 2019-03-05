<?php

namespace App\Policies;

use App\Company;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RestrictedAssetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view a restricted asset file.
     *
     * @param  \App\User  $user
     * @param  \App\Company  $company
     * @return mixed
     */
    public function view(User $user, Company $company = null)
    {
        $allowed = $user && ($company === null || $user->company_id == $company->id);

        return $allowed;
    }
}
