<?php

namespace App\Catalog\Product;

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
     * Get the user that owns the phone.
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
