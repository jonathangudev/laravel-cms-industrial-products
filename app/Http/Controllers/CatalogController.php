<?php

namespace App\Http\Controllers;

use App\Catalog\Category;
use App\User;
use Illuminate\Support\Facades\Auth;

class CatalogController extends Controller
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
     * Show the catalog dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $userCompany = Auth::user()->company_id; 

        if(empty($userCompany))
        {
            abort(403);
        }
        
        $categories = Category::whereisRoot()
            ->where('company_id', 1)
            ->get();

        return view('categories', ['categories' => $categories]);
    }
}
