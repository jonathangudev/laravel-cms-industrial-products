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
        
        $categories = Category::defaultOrder()
            ->whereIsRoot()
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

        $category = Category::defaultOrder()->descendantsAndSelf($id)
            ->where('company_id',$userCompany);

        // If category has no results, then either the category does not exist or the category does not belong to the user's company
        if($category->count() == 0)
        {
            abort(403);
        }

        $categories = $category->toTree()->first();
        //$categories = $category;

        // Categories with only products redirect to parent view
        if(count($categories->children) == 0)
        {   
            // Redirect to parent
            return redirect("/catalog/$categories->parent_id");
        }

        $emptyChildrenFlag = true;

        foreach($categories->children as $item)
        {
            if(count($item->children) > 0)
            {
                $emptyChildrenFlag = false;
            }
        }

        //If the category with $id has children with descendants of their own render the categories view with those children
        if($emptyChildrenFlag == false) 
        {
            return view('categories', ['categories' => $categories->children]);
        }

        //If the category with $id has only children with no descendants of their own render the products view with those children
        else
        {
            return view('products', ['categories' => $categories->with('products')->has('products')->get()]);
        }

    }

}