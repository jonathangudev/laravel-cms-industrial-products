<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;

abstract class AbstractCatalogController extends Controller
{
    /**
     * Apply the product collection filters to a category collection
     *
     * @param Collection $categories
     * @param integer $companyId
     * @return Collection
     */
    protected function applyProductFilters(Collection $categories, int $companyId)
    {
        return $categories->map(function ($category) use ($companyId) {
            $products = $category->products->withCompanyAttributeFilter($companyId)->normalizeAttributes();

            $category->products = $products;

            return $category;
        });
    }
}
