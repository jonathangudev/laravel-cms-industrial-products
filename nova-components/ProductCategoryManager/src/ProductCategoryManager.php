<?php

namespace Jmp\ProductCategoryManager;

use Laravel\Nova\ResourceTool;

class ProductCategoryManager extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Product Category Manager';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'product-category-manager';
    }
}
