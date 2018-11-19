<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class RestrictedAssetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Get a restricted asset
     *
     * @param string $company
     * @param string $path
     * @return void
     */
    public function getAsset($companyUuid, $path)
    {
        $user = Auth::user();
        $company = Company::where('uuid', $companyUuid)->first();

        if (Gate::forUser($user)->allows('restricted-assets.view', $company)) {
            return Storage::disk('restricted')->get($companyUuid . '/' . $path);
        }
    }
}
