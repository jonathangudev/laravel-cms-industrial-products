<?php

namespace App\Catalog\Product;

use App\Catalog\Product\AttributeValue;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class Collection extends EloquentCollection
{
    /**
     * @var Illuminate\Database\Eloquent\Collection $attributeNames
     */
    protected $attributeNames = null;

    /**
     * Normalize the product attributes
     *
     * @return App\Catalog\Product\Collection
     */
    public function normalizeAttributes()
    {
        return $this->map(function ($product) {
            $normalizedAttributes = new EloquentCollection();
            $attributes = $product->attributes;

            foreach ($this->getAttributeNames() as $attributeName) {
                $attribute = $attributes->firstWhere('attribute_name', $attributeName->name);

                if (!$attribute) {
                    $attribute = new AttributeValue([
                        'value' => null,
                        'attribute_id' => $attributeName->id,
                        'product_id' => $product->id,
                    ], false);
                }

                $normalizedAttributes->push($attribute);
            }

            $product->attributes = $normalizedAttributes;

            return $product;
        });
    }

    /**
     * Filter product attributes by a company id
     *
     * @param int $id
     * @return App\Catalog\Product\Collection
     */
    public function withCompanyAttributeFilter(int $id)
    {
        return $this->load(['attributes' => function ($query) use ($id) {
            $query->whereNull('company_id')->orWhere('company_id', $id);
        }]);
    }

    /**
     * Load the product collection with attributes
     *
     * @return App\Catalog\Product\Collection
     */
    public function withAttributes()
    {
        return $this->load('attributes');
    }

    /**
     * Get the attribute names for the product collection
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAttributeNames()
    {
        if (!$this->attributeNames) {
            $attributeNames = $this->map(function ($product) {
                return $product->attributes->map(function ($value) {
                    return $value->attribute;
                });
            })->collapse();

            $this->attributeNames = $attributeNames->unique();
        }

        return $this->attributeNames;
    }

    /**
     * Clear the internal attribute name cache
     *
     * @return void
     */
    public function clearAttributeNameCache()
    {
        $this->attributeNames = null;
    }

    /**
     * Merge two collections of products
     * @param Illuminate\Database\Eloquent\Collection $products1
     * @param Illuminate\Database\Eloquent\Collection $products2
     */
    public function mergeProducts($products)
    {
        $merged = $this;

       foreach($products as $product)
       {
           /**
            *  if the product is not in merged, add the product
            **/
           if(!($merged->contains(function ($value, $key) use ($product) {
               return $value->id == $product->id;
               })))
           {
               $merged = $merged->push($product);
           }
       }

       return $merged;
    }
}
