<?php

namespace App\Catalog\Product;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class Collection extends EloquentCollection
{
    public function withAttributeNormalization()
    {
        # code...
    }

    public function withCompanyAttributeFilter($id)
    {
        # code...
    }

    public function withAttributes()
    {
        return $this->load('attributes');
    }
}
