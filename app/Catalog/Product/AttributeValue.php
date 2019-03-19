<?php

namespace App\Catalog\Product;

use App\Catalog\Product;
use App\Catalog\Product\Attribute;
use App\Company;
use App\Events\Catalog\Product\AttributeValueCreating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

class AttributeValue extends Model
{
    use Notifiable;
    use Searchable;

    public $asYouType = true;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        return $array;
    }

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
     * flag to determine if this model can be persisted
     *
     * @var bool $canSave
     */
    protected $canSave;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @param  bool   $canSave
     * @return void
     */
    public function __construct(array $attributes = [], bool $canSave = true)
    {
        $this->canSave = $canSave;

        parent::__construct($attributes);
    }

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
    public function getAttributeNameAttribute()
    {
        return $this->attribute->name;
    }
}
