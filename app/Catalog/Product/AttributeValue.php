<?php

namespace App\Catalog\Product;

use App\Catalog\Product;
use App\Catalog\Product\Attribute;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_product_attribute_values';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value',
    ];

    /**
     * Get the product that owns the value.
     *
     * @return App\Catalog\Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the attribute that owns the value.
     *
     * @return App\Catalog\Product\Attribute
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * Get the name from the attribute
     *
     * @return string||null
     */
    public function getNameAttribute()
    {
        return $this->attribute->name;
    }

    /**
     * Get the description from the attribute
     *
     * @return string||null
     */
    public function getDescriptionAttribute()
    {
        return $this->attribute->description;
    }
}
