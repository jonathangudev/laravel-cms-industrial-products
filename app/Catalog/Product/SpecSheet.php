<?php

namespace App\Catalog\Product;

use Illuminate\Database\Eloquent\Model;
use App\Catalog\Product;
use App\Company;



class SpecSheet extends Model
{
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
     * Get the product that owns the value.
     *
     * @return App\Catalog\Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the company that owns the value.
     *
     * @return App\Company
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
