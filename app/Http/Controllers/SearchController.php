<?php

namespace App\Http\Controllers;

use App\Catalog\Category;
use App\Catalog\Product;
use App\Catalog\Product\AttributeValue;
use App\Catalog\Product\Attribute;
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
     * @return array
     */
    public function queryByCatalog($query)
    {

        $company = Auth::user()->company;

        /**
         * Build constraints for the search, restricting to bottom-level categories
         */
        $category = new Category;
        $category = $category->whereIsLeaf();
        $constraints = $category;

        /**
         * Paginate(0) workaround for eager-loading with tntsearch
         */
        $results = Category::search($query)->constrain($constraints)->where('company_id', $company->id)->paginate(0)->load('products');

        /**
         * Convert each category to category-product object
         */
        $categoryProducts = [];

        foreach ($results as $category)
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
     * @return array
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
     * @return array
     */
    public function queryByAttributeValue($query)
    {

        $company = Auth::user()->company;

        /**
         * Get all products that have the attribute value by default
         */
        $matches = AttributeValue::search($query)->get()->whereStrict('company_id',null);

        $attributes = $matches->pluck('attribute_id');

        $attributes = $attributes->unique();

        $products   = $matches->pluck('product_id');

        $products   = $products->unique();

        /**
         * Gets all potential cases where company specified attribute values may have overwritten a specific attribute value
         */
        $companySpecified = AttributeValue::where('company_id','=',$company->id)
            ->whereIn('attribute_id', $attributes)
            ->whereIn('product_id', $products)
            ->get();

        foreach($attributes as $attribute)
        {
            $attributesProducts = $matches->where('attribute_id','=',$attribute)->pluck('product_id');

            foreach($attributesProducts as $attributesProduct)
            {
                /**
                 * Kick out this row from the matches if company-specified attribute values exist for this attribute-product combination
                 */
                $matches = $matches->reject(function($value, $key) use ($companySpecified, $attribute, $attributesProduct){
                    return ($value->attribute_id == $attribute && $value->product_id == $attributesProduct && $this->companySpecifiedContains($companySpecified, $attribute, $attributesProduct));
                });

            }

        }

        $productIds1 = $matches->pluck('product_id');

        /**
         * Get all products that have the attribute because it was specified by the company
         */
        $matches = AttributeValue::search($query)->get()->where('company_id','=',$company->id);

        $productIds2 = $matches->pluck('product_id');

        /**
         * Merge the results of the two queries
         */
        $productIds = $productIds1->merge($productIds2)->unique();

        $products = Product::whereIn('id', $productIds)->with('categories')->get();

        $categoryProducts = $this->buildCategoryProducts($products, $company);

        return $categoryProducts;

        //return view('search-results',['results' => $categoryProducts]);

    }

    /**
     * Search the attribute names
     *
     * @param string $query
     * @return array
     */
    public function queryByAttribute($query)
    {

        $company = Auth::user()->company;

        $attributes = Attribute::search($query)->get()->pluck('id')->all();

        /**
         * Get all products that have this attribute
         */
        $productCompanies = AttributeValue::select('product_id','company_id')->whereIn('attribute_id',$attributes)->get();

        /**
         * Remove all products that belong to another company.  
         * NULL company value means that this attribute applies to this product by default.
         * Thus NULL company value means that this attribute applies to this product for all companies.
         */

        $filteredProductCompanies = $productCompanies->filter(function($value,$key) use ($company) {
            return ($value->company_id == $company->id || $value->company_id === null);
        });

        $filteredProducts = $filteredProductCompanies->pluck('product_id');

        $uniqueProducts = $filteredProducts->unique();

        $products = Product::whereIn('id', $uniqueProducts)->with('categories')->with('attributes')->get();

        $categoryProducts = $this->buildCategoryProducts($products, $company);

        return $categoryProducts;

        //return view('search-results',['results' => $categoryProducts]);

    }

    /**
     * Search by (1) Product, (2) Catalog Content, (3) Attribute Name, (4) Attribute Value and display results
     *
     * @param string $query
     * @return \Illuminate\Http\Response
     */
    public function queryByCombo($query)
    {
        $cp1 = $this->queryByProduct($query);
        $cp2 = $this->queryByCatalog($query);
        $cp3 = $this->queryByAttribute($query);
        $cp4 = $this->queryByAttributeValue($query);

        $mergedCategoryProducts = array_merge($cp1, $cp2, $cp3, $cp4);

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

    /**
     * Converts an array of products into an array of objects with a Category and Product property
     *
     * @param array $products
     * @param App\Company $company
     * @return array
     */
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

    /**
     * Merges two arrays of products
     *
     * @param array $products1
     * @param array $products2
     * @return array
     */
    protected function mergeProducts($products1, $products2)
    {

        $products1 = collect($products1);
        $products2 = collect($products2);

        $mergedProducts = $products1->merge($products2);

        $uniqueProducts = $mergedProducts->unique('id');

        return $uniqueProducts->all();

    }

    /**
     * Merges two arrays of products
     *
     * @parem Illuminate\Database\Eloquent\Collection $companySpecified
     * @param int $attribute
     * @param int $attributesProduct
     * @return boolean
     */
    protected function companySpecifiedContains($companySpecified, $attribute, $attributesProduct)
    {
        return $companySpecified->contains(function ($value, $key) use($attribute, $attributesProduct) {
            return ($value->attribute_id == $attribute && $value->product_id == $attributesProduct);
        });
    }

}
