<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeUser;
use App\User;

class EmailPreviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Get the user welcome email preview
     *
     * @return WelcomeUser
     */
    public function getUserWelcomePreview()
    {
        $user = factory(User::class)->make();

        return new WelcomeUser($user);
    }
}
