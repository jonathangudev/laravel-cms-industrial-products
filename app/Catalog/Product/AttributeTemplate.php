<?php

namespace App\Catalog\Product;

use App\Catalog\Product;
use App\Catalog\Product\Attribute;
use Illuminate\Database\Eloquent\Model;

class AttributeTemplate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_product_attribute_templates';

    /**
     * Get the attributes that belong to the attribute Set.
     *
     * @return App\Catalog\Product\Attribute
     */
    public function attributes()
    {
        return $this->belongsToMany(
            Attribute::class,
            'catalog_product_attribute__catalog_product_attribute_template',
            'attribute_template_id',
            'attribute_id'
        );
    }

    /**
     * Get the products for the attribute Set.
     *
     * @return App\Catalog\Product
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
