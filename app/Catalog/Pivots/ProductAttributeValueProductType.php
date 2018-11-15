<?php
namespace App\Catalog\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductAttributeValueProductType extends Pivot
{

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function podcast()
    {
        return $this->belongsTo('App\Podcast');
    }

    public function audioFiles()
    {
        return $this->hasManyThrough('App\AudioFiles', 'App\Podcast');
    }

}
