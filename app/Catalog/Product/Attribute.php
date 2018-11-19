<?php

namespace App\Catalog\Product;

use App\Catalog\Product\AttributeSet;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_product_attributes';

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
     * Get the value associated with the attribute
     *
     * @return App\Catalog\Product\AttributeValue
     */
    public function value()
    {
        return $this->hasOne(AttributeValue::class);
    }

    /**
     * Get the attribute sets that belong to the attribute.
     *
     * @return App\Catalog\Product\AttributeSet
     */
    public function attributeSets()
    {
        return $this->belongsToMany(
            AttributeSet::class,
            'catalog_product_attribute__catalog_product_attribute_set',
            'attribute_id',
            'attribute_set_id'
        );
    }
}
