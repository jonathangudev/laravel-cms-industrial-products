<?php

namespace App\Http\Controllers;

use App\Catalog\Category;
use App\Catalog\Product;
use App\Catalog\Product\AttributeValue;
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

        /**
         * Paginate(0) workaround for eager-loading with tntsearch
         */

         // TODO - Fix major issue of how to handle default values
        $results = Category::search($query)->where('company_id', $company->id)->paginate(0)->load('products');

        /**
         * Filter down results to only get bottom-level categories (product groups)
         */
        $filtered = $results->filter(function($value,$key) {
            return $value->isLeaf();
        });

        /**
         * Convert each category to category-product object
         */

        $categoryProducts = [];

        foreach ($filtered as $category)
        {
            $object = new \stdClass();
            $object->category = $category;

            /**
             *  Getting category's collection of products as an array
             */
            $object->products = $category->products->all();

            $object->categoryId = $category->id;

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

        /**
         * Paginate(0) workaround for eager-loading with tntsearch
         */
        $products = Product::search($query)->paginate(0)->load('categories');;

        $categoryProducts = $this->buildCategoryProducts($products, $company);

        return $categoryProducts;

    }

    /**
     * Search the attribute values
     *
     * @param string $query
     * @return Collection
     */
    public function queryByAttributeValue($query)
    {

        $company = Auth::user()->company;

        $attributes = AttributeValue::search($query)->where('company_id', $company->id)->paginate(0)->load('product');

        $products = new \Illuminate\Database\Eloquent\Collection;

        foreach($attributes as $attribute)
        {
            $products->push($attribute->product);
        }

        $products->load('categories');

        $categoryProducts = $this->buildCategoryProducts($products, $company);

        return $categoryProducts;

    }

    /**
     * Search the products and category
     *
     * @param string $query
     * @return Collection
     */
    public function queryByCombo($query)
    {
        $cp1 = $this->queryByProduct($query);
        $cp2 = $this->queryByCatalog($query);

        $mergedCategoryProducts = array_merge($cp1, $cp2);

        $uniqueCatIds = array_unique( array_column($mergedCategoryProducts, 'categoryId') );

        $resultCategoryProducts = [];

        foreach($uniqueCatIds as $catId)
        {
            /**
             * Create a new Category-Product Object
             */
            $object = new \stdClass();
            $object->categoryId = $catId;
            $object->products = [];

            foreach($mergedCategoryProducts as $categoryProduct)
            {

                if($catId == $categoryProduct->categoryId)
                {

                    $object->category = $categoryProduct->category;

                    $object->products = $this->mergeProducts($object->products, $categoryProduct->products);
                }
            }

            $resultCategoryProducts[] = $object;
        }

        return view('search-results',['results'=>$resultCategoryProducts]);

    }

    protected function buildCategoryProducts($products, $company)
    {

        $categoryProducts = [];

        foreach($products as $product)
        {
            $categories = $product->categories;

            $filteredCategories = $categories->filter(function($value,$key) use ($company) {
                return $value->company->id == $company->id;
            });

            foreach($filteredCategories as $category)
            {
                $object = new \stdClass();
                $object->category = $category;
                $object->categoryId = $category->id;
                $object->products[] = $product;
    
                $categoryProducts[] = $object;
            }

        }

        return $categoryProducts;

    }

    protected function mergeProducts($products1, $products2)
    {

        $products1 = collect($products1);
        $products2 = collect($products2);

        $mergedProducts = $products1->merge($products2);

        $uniqueProducts = $mergedProducts->unique('id');

        return $uniqueProducts->all();

    }

}
