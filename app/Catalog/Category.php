<?php

namespace App\Catalog;

use App\Company;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

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
