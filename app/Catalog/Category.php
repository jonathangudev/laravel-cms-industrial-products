<?php

namespace App\Catalog;

use App\Company;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Laravel\Scout\Searchable;

class Category extends Model implements HasMedia
{
    use NodeTrait;
    use HasMediaTrait;
    use Searchable {
        \Kalnoy\Nestedset\NodeTrait::usesSoftDelete insteadof \Laravel\Scout\Searchable; 
    }

    public $asYouType = true;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->only(['id','content']);

        return $array;
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'company_id',
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

    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('category-thumbnail')
            ->useDisk('restricted');

        $this
            ->addMediaCollection('category-gallery')
            ->useDisk('restricted');
    }

    /**
     * Get the company that owns the category.
     *
     * @return App\Company
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the products for the category.
     *
     * @return App\Catalog\Product
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'catalog_category__catalog_product');
    }
}
