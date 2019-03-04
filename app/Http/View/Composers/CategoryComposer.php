<?php

namespace App\Http\View\Composers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CategoryComposer
{
    /**
     * @var User $user
     */
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();

        if (!Auth::check() || !$this->user) {
            abort(403);
        }
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if ($company = $this->user->company) {
            $view->with('categories', $company->categories);
        }
    }
}
