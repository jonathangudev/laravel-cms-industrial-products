<?php

namespace App\Http\Controllers;

use App\Catalog\Category;
use App\Catalog\Product;
use App\Catalog\Product\AttributeValue;
use App\Catalog\Product\Attribute;
use App\Catalog\Product\Collection as ProductCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

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
         * Build constraints for the search, restricting to bottom-level categories and loading product relation
         */
        $category = new Category;
        $category = $category->whereIsLeaf()->with(['products' => function ($query) {
            $query->with('attributes');
        }]);
        $constraints = $category;

        // Search
        $categories = Category::search($query)->constrain($constraints)->where('company_id', $company->id)->get();

        //$categories = $this->applyProductFilters($results, $company->id);

        return $categories;

        /*return view('search-results', [
            'categories' => $categories,
            'currentCategory' => null,
            'categoryAncestors' => null,
        ]);*/

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
         * Build constraints for the search, loading category relation
         */
        $product = new Product;
        $product = $product->with('categories')->with('attributes');
        $constraints = $product;

        // Search (pulls all matches without company restriction because these are handled at category level)
        $products = Product::search($query)->constrain($constraints)->get();

        $categories = $this->buildCategoryProducts($products, $company);

        //$categories = $this->applyProductFilters($categories, $company->id);

        return $categories;

        /*return view('search-results', [
            'categories' => $categories,
            'currentCategory' => null,
            'categoryAncestors' => null,
        ]);*/
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

        // Get all products that have this attribute
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

        $categories = $this->buildCategoryProducts($products, $company);

        //$categories = $this->applyProductFilters($categories, $company->id);

        return $categories;

        /*return view('search-results', [
            'categories' => $categories,
            'currentCategory' => null,
            'categoryAncestors' => null,
        ]);*/
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

        // Get all products that have the attribute value by default (i.e. company is null)
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

        // Get all products that have the attribute value because it was specified by the company
        $matches = AttributeValue::search($query)->get()->where('company_id','=',$company->id);

        $productIds2 = $matches->pluck('product_id');

        /**
         * Merge the results of the two queries
         */
        $productIds = $productIds1->merge($productIds2)->unique();

        $products = Product::whereIn('id', $productIds)->with('categories')->with('attributes')->get();

        $categories = $this->buildCategoryProducts($products, $company);

        //$categories = $this->applyProductFilters($categories, $company->id);

        return $categories;

        /*return view('search-results', [
            'categories' => $categories,
            'currentCategory' => null,
            'categoryAncestors' => null,
        ]);*/

    }

    /**
     * Search by (1) Product, (2) Catalog Content, (3) Attribute Name, (4) Attribute Value and display results
     *
     * @param string $query
     * @return \Illuminate\Http\Response
     */
    public function queryByCombo($query)
    {

        $company = Auth::user()->company;

        $cp1 = $this->queryByProduct($query);
        $cp2 = $this->queryByCatalog($query);
        $cp3 = $this->queryByAttribute($query);

        //dd($cp3);
        $cp4 = $this->queryByAttributeValue($query);

        /**
         * Merge all the categories (using push instead of merge because merge will overwrite categories with the same ids)
         */
        $mergedCategoryProducts= $cp1;

        foreach($cp2 as $item)
        {
            $mergedCategoryProducts->push($item);
        }

        foreach($cp3 as $item)
        {
            $mergedCategoryProducts->push($item);
        }

        foreach($cp4 as $item)
        {
            $mergedCategoryProducts->push($item);
        }

        $uniqueCatIds = $mergedCategoryProducts->pluck('id')->unique();

        $resultCategories = new Collection;

        foreach($uniqueCatIds as $catId)
        {
            /**
             * Create a new Category-Product Object
             */
            $object = new Category;
            $merged = new ProductCollection();

            foreach($mergedCategoryProducts as $categoryProduct)
            {

                if($catId == $categoryProduct->id)
                {
  
                    /**
                     * Create the category if it hasn't been set yet
                     */
                    if(!isset($object->id))
                    {
                        $object = new Category;
                        $object = $categoryProduct;
                    }

                    foreach($categoryProduct->products as $product)
                    {
    
                        //if the product is not in merged, add the product
                        if(!($merged->contains(function ($value, $key) use ($product) {
                            return $value->id == $product->id;
                            })))
                        {
                            $merged = $merged->push($product);
                        }
                    }

                }

            }

            $object->products = $merged;

            $resultCategories->push($object);

        }

        $resultCategories = $this->applyProductFilters($resultCategories, $company->id);

        return view('search-results', [
            'categories' => $resultCategories,
            'currentCategory' => null,
            'categoryAncestors' => null,
        ]);
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

        $categoryProducts = new Collection;

        foreach($products as $product)
        {
            $categories = $product->categories;

            $filteredCategories = $categories->filter(function($value,$key) use ($company) {
                return $value->company->id == $company->id;
            });

            $p = $product;
            unset($p->categories);

            foreach($filteredCategories as $category)
            {
                $newCat = $category;
                $productCollection = new ProductCollection([$p]);
                $newCat->setRelation('products', $productCollection);
                $categoryProducts->push($newCat);
            }

        }

        return $categoryProducts;

    }

    /**
     * Merges two arrays of products
     *
     * @param Collection $products1
     * @param Collection $products2
     * @return array
     */
    protected function mergeProducts($products1, $products2)
    {

        $mergedProducts = $products1->merge($products2);

        $uniqueProducts = $mergedProducts->unique('id');

        return $uniqueProducts->all();

    }

    /**
     * Determines if the two values (attribute & product) are contained in the collection (of AttributeValues)
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

    /**
     * Apply the product collection filters to a category collection
     *
     * @param Collection $categories
     * @param integer $companyId
     * @return Collection
     */
    protected function applyProductFilters($categories, int $companyId)
    {
        return $categories->map(function ($category) use ($companyId) {
            $products = $category->products->withCompanyAttributeFilter($companyId)->normalizeAttributes();

            $category->products = $products;

            return $category;
        });
    }


}
