<?php

namespace App\Catalog;

use App\Catalog\Product\AttributeTemplate;
use App\Catalog\Product\AttributeValue;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the attribute template for the product.
     *
     * @return App\Catalog\Product\AttributeTemplate
     */
    public function attributeTemplate()
    {
        return $this->belongsTo(AttributeTemplate::class, 'attribute_template_id');
    }

    /**
     * Get the attributes for the product.
     *
     * @return App\Catalog\Product\AttributeValue
     */
    public function attributes()
    {
        return $this->hasMany(AttributeValue::class);
    }

    /**
     * Get the categories for the product.
     *
     * @return App\Catalog\Category
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'catalog_category__catalog_product');
    }
}
