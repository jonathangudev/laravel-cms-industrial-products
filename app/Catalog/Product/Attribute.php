<?php

namespace App\Catalog\Product;

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
     * Get the attribute templates that belong to the attribute.
     *
     * @return App\Catalog\Product\AttributeTemplate
     */
    public function attributeTemplates()
    {
        return $this->belongsToMany(
            AttributeTemplate::class,
            'catalog_product_attribute__catalog_product_attribute_template',
            'attribute_id',
            'attribute_template_id'
        );
    }
}
