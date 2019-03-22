<?php

namespace App\Http\Controllers;

use App\Catalog\Category;
use App\Catalog\Product;
use App\Catalog\Product\AttributeValue;
use App\Catalog\Product\Attribute;
use App\Http\Controllers\AbstractCatalogController;
use Illuminate\Support\Facades\Auth;

class CatalogSearchController extends AbstractCatalogController
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
    protected function queryByCategory($query)
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

        return $categories;
    }

    /**
     * Search the products
     *
     * @param string $query
     * @return array
     */
    protected function queryByProduct($query)
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

        return $products;
    }

    /**
     * Search the attribute names
     *
     * @param string $query
     * @return array
     */
    protected function queryByAttribute($query)
    {
        $company = Auth::user()->company;

        $attributes = Attribute::search($query)->get()->pluck('id')->all();

        // Get all ids of all products that have this attribute
        $productCompanies = AttributeValue::select('product_id', 'company_id')->whereIn('attribute_id', $attributes)->get();

        /**
         * Remove all products that belong to another company.  
         * NULL company value means that this attribute applies to this product by default.
         * Thus NULL company value means that this attribute applies to this product for all companies.
         */

        $filteredProductCompanies = $productCompanies->filter(function ($value, $key) use ($company) {
            return ($value->company_id == $company->id || $value->company_id === null);
        });

        $filteredProducts = $filteredProductCompanies->pluck('product_id');

        $uniqueProducts = $filteredProducts->unique();

        // Get products by id (pulls all matches without company restriction because these are handled at category level)
        $products = Product::whereIn('id', $uniqueProducts)->with('categories')->with('attributes')->get();

        return $products;
    }

    /**
     * Search the attribute values
     *
     * @param Request $request
     * @return array
     */
    protected function queryByAttributeValue(Request $request)
    {
        $query = $request->input('query');

        $company = Auth::user()->company;

        // Get ids of all products that have the attribute value by default (i.e. company is null)
        $matches = AttributeValue::search($query)->get()->whereStrict('company_id', null);

        $attributes = $matches->pluck('attribute_id');

        $attributes = $attributes->unique();

        $products   = $matches->pluck('product_id');

        $products   = $products->unique();

        /**
         * Gets all potential cases where company specified attribute values may have overwritten a specific attribute value
         */
        $companySpecified = AttributeValue::where('company_id', '=', $company->id)
            ->whereIn('attribute_id', $attributes)
            ->whereIn('product_id', $products)
            ->get();

        foreach ($attributes as $attribute) {
            $attributesProducts = $matches->where('attribute_id', '=', $attribute)->pluck('product_id');

            foreach ($attributesProducts as $attributesProduct) {
                /**
                * Kick out this row from the matches if company-specified attribute values exist for this attribute-product combination
                */
                $matches = $matches->reject(function ($value, $key) use ($companySpecified, $attribute, $attributesProduct) {
                    return ($value->attribute_id == $attribute && $value->product_id == $attributesProduct && $this->companySpecifiedContains($companySpecified, $attribute, $attributesProduct));
                });
            }
        }

        $productIds1 = $matches->pluck('product_id');

        // Get ids of all products that have the attribute value because it was specified by the company
        $matches = AttributeValue::search($query)->get()->where('company_id', '=', $company->id);

        $productIds2 = $matches->pluck('product_id');

        /**
         * Merge the results of the two queries
         */
        $productIds = $productIds1->merge($productIds2)->unique();

        // Get products by id (pulls all matches without company restriction because these are handled at category level)
        $products = Product::whereIn('id', $productIds)->with('categories')->with('attributes')->get();

        return $products;
    }

    /**
     * Search by (1) Product, (2) Attribute Name, (3) Attribute Value and display results, (4) Catalog Content,
     *
     * @param string $query
     * @return \Illuminate\Http\Response
     */
    public function queryByCombo($query)
    {
        $company = Auth::user()->company;

        $productsByProduct = $this->queryByProduct($query);
        $productsByAttribute = $this->queryByAttribute($query);
        $productsByAttributeValue = $this->queryByAttributeValue($query);
        $categoriesByCategory = $this->queryByCategory($query);

        $mergedProducts = $productsByProduct->concat($productsByAttribute)->concat($productsByAttributeValue)->unique();
        $productIds = $mergedProducts->pluck('id');

        $uniqueCategories = $this->getProductCollectionCategories($mergedProducts, $company);

        // Add in categories from queryByCategory
        $uniqueCategories = $uniqueCategories->merge($categoriesByCategory)->unique('id');

        $categories = $this->applyProductFilters($uniqueCategories, $company->id);

        $categoriesWithProducts = $categories->map(function ($category) use ($productIds) {
            $filteredProds = $category->products->whereIn('id', $productIds);

            if ($filteredProds->isNotEmpty()) {
                $category->products = $filteredProds;
            }

            return $category;
        });

        return view('search-results', [
            'categories' => $categoriesWithProducts,
            'currentCategory' => null,
            'categoryAncestors' => null,
        ]);
    }

    /**
     * Determines if the two values (attribute & product) are contained in the collection (of AttributeValues)
     *
     * @param Illuminate\Database\Eloquent\Collection $companySpecified
     * @param int $attribute
     * @param int $attributesProduct
     * @return boolean
     */
    protected function companySpecifiedContains($companySpecified, $attribute, $attributesProduct)
    {
        return $companySpecified->contains(function ($value, $key) use ($attribute, $attributesProduct) {
            return ($value->attribute_id == $attribute && $value->product_id == $attributesProduct);
        });
    }

    /**
     * Gets the unique categories of a collection of products
     * 
     * @param Illuminate\Database\Eloquent\Collection $products
     * @param App\Company
     * 
     * @return Illuminate\Database\Eloquent\Collection 
     */
    protected function getProductCollectionCategories($products, $company)
    {
        return $products->map(function ($product) use ($company) {
            return $product->categories->where('company_id', $company->id);
        })
            ->flatten(1)
            ->unique();
    }
}
