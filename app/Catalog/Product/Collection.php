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
        return $this->load(['attributes' => function ($query) use ($id) {
            $query->where('company_id', $id);
        }]);
    }

    public function withAttributes()
    {
        return $this->load('attributes');
    }
}
