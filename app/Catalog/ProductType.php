<?php

namespace App\Catalog;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_product_types';

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
     * Get the products for the type.
     */
    public function products()
    {
        return $this->hasMany('App\Catalog\Product');
    }
}
