<?php

namespace App\Pages\ProductsAndServices;

use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages_products_and_services_rows';

    /**
     * Get the content blocks for the row
     * 
     * @return Content
     */
    public function contents()
    {
        return $this->hasMany(Content::class)->orderBy('sort_order', 'asc');
    }
}
