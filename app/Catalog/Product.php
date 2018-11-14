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
     */
    public function type()
    {
        return $this->belongsTo('App\Catalog\ProductType');
    }

    public function attributeValues()
    {
        return $this->hasMany('App\Catalog\AttributeValue')
            ->using('App\Catalog\Pivots\ProductAttributeValue');
    }
}
