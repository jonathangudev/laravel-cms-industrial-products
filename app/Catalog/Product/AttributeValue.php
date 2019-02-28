<?php

namespace App\Catalog\Product;

use App\Catalog\Product;
use App\Catalog\Product\Attribute;
use App\Company;
use App\Events\Catalog\Product\AttributeValueCreating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AttributeValue extends Model
{
    use Notifiable;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'creating' => AttributeValueCreating::class,
    ];

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
        'product_id',
        'attribute_id',
        'company_id',
        'is_hidden',
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
     * Get the company that owns the value.
     *
     * @return App\Company
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
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
