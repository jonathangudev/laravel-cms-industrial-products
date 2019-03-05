<?php

namespace App\Catalog;

use App\Company;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Category extends Model implements HasMedia
{
    use NodeTrait;
    use HasMediaTrait;

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
    protected $fillable = ['name', 'company_id'];

    /**
     * Register the media conversions for this model
     *
     * @param Media $media
     * @return void
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(250)
            ->height(250)
            ->extractVideoFrameAtSecond(1);

        $this->addMediaConversion('medium')
            ->width(500)
            ->height(500)
            ->extractVideoFrameAtSecond(1);
    }

    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('gallery')
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
