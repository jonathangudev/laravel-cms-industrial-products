<?php

namespace App\Catalog;

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
     * Get the type that owns the product.
     *
     * @return App\Catalog\ProductType
     */
    public function type()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function attributes()
    {
        return $this->hasMany(Product\AttributeValue::class);
    }
}
