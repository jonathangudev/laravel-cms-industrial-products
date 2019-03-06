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
            ->where('company_id', $userCompany)
            ->get();

        return view('categories', ['categories' => $categories]);
    }

    /**
     * Show a specific category
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategory($id)
    {
        $userCompany = Auth::user()->company_id; 

        // Users without a company assigned can not access ANY categories
        if(empty($userCompany))
        {
            abort(403);
        }

        $category = Category::descendantsAndSelf($id)
            ->where('company_id',$userCompany);

        // If category has no results either the category does not exist or the category does not belong to the user's company
        if($category->count() == 0)
        {
            abort(403);
        }

        return view('categories', ['categories' => $category->toTree()]);
    }

}