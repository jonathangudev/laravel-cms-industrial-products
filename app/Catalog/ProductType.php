<?php

namespace App\Catalog;

use App\Catalog\Product;
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
     *
     * @return App\Catalog\Product
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
