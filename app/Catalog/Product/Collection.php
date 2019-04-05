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
        $products = $this->load(['attributes' => function ($query) use ($id) {
            $query->whereNull('company_id')->orWhere('company_id', $id);
        }]);

        return $products->map(function ($product) use ($id) {

            $attributes = $product->attributes;

            $defaultAttributes = $attributes->whereStrict('company_id', null);
            $companySpecifiedAttributes = $attributes->where('company_id', $id);

            // removes all default attribute values that have been overridden by a company-specified attribute value
            $cleanedDefaultAttributes = $defaultAttributes->whereNotIn('attribute_id', $companySpecifiedAttributes->pluck('attribute_id'));

            // combines non-overridden default attribute values with all company-specified attribute values
            $product->attributes = $companySpecifiedAttributes->merge($cleanedDefaultAttributes);

            return $product;
        });
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
}
