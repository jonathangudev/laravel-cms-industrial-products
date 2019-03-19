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

        //foreach category in merged
            //find matching category in each query 

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

                    /*foreach($categoryProduct->products as $product)
                    {
                        $object->products = $this->addProductIfNew($object->products, $product);
                    }*/

                    $object->products = $this->mergeProducts($object->products, $categoryProduct->products);
                }
            }

            $resultCategoryProducts[] = $object;
        }

        dd($resultCategoryProducts);

    }

    protected function addProductIfNew($productArray, $product)
    {
        foreach($productArray as $item)
        {
            if($item->id == $product->id)
            {
                return $productArray;
            }
        }

        $productArray[] = $product;
        return $productArray;
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
                // TODO - remove if category - product merging will be done at a later time
                //$categoryProducts = $this->addCategoryProduct($categoryProducts, $product, $category);

                $object = new \stdClass();
                $object->category = $category;
                $object->categoryId = $category->id;
                $object->products[] = $product;
    
                $categoryProducts[] = $object;
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
    /*protected function addCategoryProduct($categoryProducts, $product, $category)
    {
        $newCategoryFlag = true;

        /**
         * Loops through all category-products and adds a product to the products associated with a category if there's a match on the category
         

        foreach((array) $categoryProducts as $key => $categoryProduct)
        {
            if($categoryProduct->category->id == $category->id)
            {
                $categoryProducts[$key]->products[] = $product;
                $newCategoryFlag = false;
            }
        }

        /**
         * If the category is not found in category-products, it's a new category, which needs to have the product added to it
         
        if($newCategoryFlag)
        {
            $object = new \stdClass();
            $object->category = $category;
            $object->categoryId = $category->id;
            $object->products[] = $product;

            $categoryProducts[] = $object;
        }

        return $categoryProducts;
    }*/

    protected function mergeProducts($products1, $products2)
    {

        $products1 = collect($products1);
        $products2 = collect($products2);

        $mergedProducts = $products1->merge($products2);

        $uniqueProducts = $mergedProducts->unique('id');

        return $uniqueProducts->all();

    }


}
