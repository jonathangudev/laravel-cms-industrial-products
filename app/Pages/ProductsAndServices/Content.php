<?php

namespace App\Pages\ProductsAndServices;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Content extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages_products_and_services_contents';

    /**
     * Register the media collections for this model
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('products-and-services-content-image')
            ->useDisk('public');
    }
}
