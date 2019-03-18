<?php

namespace App\Http\Controllers;

use App\Catalog\Category;
use App\Catalog\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
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
     * Search the bottom-level categories (product groups) for the query
     *
     * @param string $query
     * @return Collection
     */
    public function queryByCatalog($query)
    {

        $company = Auth::user()->company;

        $results = Category::search($query)->where('company_id', $company->id)->get();

        /**
         * 
         * Filter down results to only get bottom-level categories (product groups)
         * 
         */

        $filtered = $results->filter(function($value,$key) {
            return $value->isLeaf();
        });

        /**
         * 
         * Convert each category to category-product object
         * 
         */

        $categoryProducts = [];

        foreach ($filtered as $category)
        {
            $object = new \stdClass();
            $object->category = $category;

            // Getting category's collection of products as an array
            $object->products = $category->products->all();

            $categoryProducts[] = $object;
        }

        return $categoryProducts;

    }

    /**
     * Search the products
     *
     * @param string $query
     * @return Collection
     */
    public function queryByProduct($query)
    {

        $company = Auth::user()->company;

        $products = Product::search($query)->get();

        $categoryProducts = [];

        foreach($products as $product)
        {

            $categories = $product->categories;

            $filteredCategories = $categories->filter(function($value,$key) use ($company) {
                return $value->company->id == $company->id;
            });

            foreach($filteredCategories as $category)
            {
                $categoryProducts = $this->addCategoryProduct($categoryProducts, $product, $category);
            }

        }

        return $categoryProducts;

    }

    /**
     * Adds products to a category
     *
     * @param array
     * @param Category
     * @param Product 
     * @return stdClass
     */
    protected function addCategoryProduct($categoryProducts, $product, $category)
    {
        $newCategoryFlag = true;

        /**
         * 
         * Loops through all category-products and adds a product to the products associated with a category if there's a match on the category
         * 
         */

        foreach((array) $categoryProducts as $key => $categoryProduct)
        {
            if($categoryProduct->category->id == $category->id)
            {
                $categoryProducts[$key]->products[] = $product;
                $newCategoryFlag = false;
            }
        }

        /**
         * 
         * If the category is not found in category-products, it's a new category, which needs to have the product added to it
         * 
         */
        if($newCategoryFlag)
        {
            $object = new \stdClass();
            $object->category = $category;
            $object->products[] = $product;

            $categoryProducts[] = $object;
        }

        return $categoryProducts;
    }

    public function queryByCombo($query)
    {
        $cp1 = $this->queryByProduct($query);
        $cp2 = $this->queryByCatalog($query);

        $com = array_merge($cp1,$cp2);

        dd($com);
    }

}
