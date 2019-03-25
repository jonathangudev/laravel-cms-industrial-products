<?php

namespace App\Http\Controllers;

use App\Catalog\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class CatalogController extends AbstractCatalogController
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
     * Show the catalog dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCompany = Auth::user()->company_id;

        if (empty($userCompany)) {
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
        $company = Auth::user()->company;

        /**
         * Abort unauthorized for users without a company
         */
        if (empty($company)) {
            abort(403);
        }

        $categories = Category::with(['children', 'products'])
            ->defaultOrder()
            ->descendantsAndSelf($id)
            ->where('company_id', $company->id);

        /**
         * If there are no category results, abort
         */
        if ($categories->isEmpty()) {
            abort(403);
        }

        $category = $categories->firstWhere('id', $id);

        /**
         * Redirect categories without children to their parent's view
         */
        if ($category->children->isEmpty()) {
            return redirect()->route("catalog.category", ['id' => $category->parent_id]);
        }

        $childrenWithDescendants = $category->children->filter(function ($child) {
            return $child->children->isNotEmpty();
        });

        $categoryAncestors = Category::defaultOrder()->ancestorsAndSelf($id);

        /**
         * If the category has children with descendants of their own render the categories view
         * with the children, otherwise render the products view with the children.
         *
         * If rendering the products view, some of the children must have products, otherwise abort
         * with a 404 error.
         */
        if ($childrenWithDescendants->isNotEmpty()) {
            return view('categories', [
                'categories' => $this->applyProductFilters($category->children, $company->id),
                'currentCategory' => $category,
                'categoryAncestors' => $categoryAncestors,
            ]);
        } else {
            $filteredCategories = $category->children->filter(function ($child) {
                return ($child->content ||
                    $child->hasMedia('category-gallery') ||
                    $child->products->count() > 0);
            });

            if ($filteredCategories->isEmpty()) {
                abort(404, 'The category you are trying to view doesn\'t have any products');
            }

            return view('products', [
                'categories' => $this->applyProductFilters($filteredCategories, $company->id),
                'currentCategory' => $category,
                'categoryAncestors' => $categoryAncestors,
            ]);
        }
    }
}
