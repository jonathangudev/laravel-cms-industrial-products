<?php

namespace App\Pages;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class HomePage extends Model implements HasMedia
{
    use HasMediaTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages_home_pages';

    /**
     * Register the media collections for this model
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('footer-image')
            ->useDisk('restricted');
    }
}
