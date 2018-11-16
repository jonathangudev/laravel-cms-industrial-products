<?php
namespace App\Catalog\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductAttributeValue extends Pivot
{
    public function product()
    {
        return $this->belongsTo('App\Catalog\Product');
    }

    public function attributeValue()
    {
        return $this->belongsTo('App\Catalog\AttributeValue');
    }
}
