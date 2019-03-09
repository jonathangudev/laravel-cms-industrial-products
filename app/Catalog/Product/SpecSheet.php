<?php

namespace App\Catalog\Product;

use App\Catalog\Product;
use App\Company;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class SpecSheet extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_product_spec_sheets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'company_id',
        'pdf',
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
            ->addMediaCollection('spec-sheet')
            ->useDisk('restricted');
    }

    /**
     * Get the product that owns the sheet.
     *
     * @return App\Catalog\Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the company that owns the sheet.
     *
     * @return App\Company
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
