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

        // Only get the category by id if the user's assigned company has that category
        $category = Category::where('company_id', $userCompany)
            ->find($id)
            ->get();

        if(empty($category)) 
        {
            abort(403);
        }

        return view('categories', ['categories' => $category->toTree()]);

    }

}