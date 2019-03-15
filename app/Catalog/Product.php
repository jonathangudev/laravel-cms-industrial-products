<?php


namespace App\Catalog;


use App\Catalog\Product\AttributeTemplate;
use App\Catalog\Product\AttributeValue;
use App\Catalog\Product\Collection as ProductCollection;
use App\Catalog\Product\SpecSheet;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Laravel\Scout\Searchable;


class Product extends Model implements HasMedia
{

    use HasMediaTrait;
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
     * Register the media conversions for this model
     *
     * @param Media $media
     * @return void
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->extractVideoFrameAtSecond(1);

        $this->addMediaConversion('medium')
            ->width(600)
            ->height(600)
            ->extractVideoFrameAtSecond(1);
    }

    /**
     * Register the media collections for this model
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('product-thumbnail')
            ->useDisk('restricted');
    }

    /**
     * Get the attribute template for the product.
     *
     * @return App\Catalog\Product\AttributeTemplate
     */
    public function attributeTemplate()
    {
        return $this->belongsTo(AttributeTemplate::class, 'attribute_template_id');
    }

    /**
     * Get the attributes for the product.
     *
     * @return App\Catalog\Product\AttributeValue
     */
    public function attributes()
    {
        return $this->hasMany(AttributeValue::class);
    }

    /**
     * Get the categories for the product.
     *
     * @return App\Catalog\Category
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'catalog_category__catalog_product');
    }

    /**
     * Get the spec sheets for the product.
     *
     * @return App\Catalog\Product\SpecSheet
     */
    public function specSheets()
    {
        return $this->hasMany(SpecSheet::class);
    }

    /**
     * Create a new Eloquent Collection instance.
     *
     * @param  array  $models
     * @return \App\Catalog\Product\Collection
     */
    public function newCollection(array $models = [])
    {
        return new ProductCollection($models);
    }
}
