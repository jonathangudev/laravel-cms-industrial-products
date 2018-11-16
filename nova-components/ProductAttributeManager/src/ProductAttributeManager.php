<?php

namespace Jmp\ProductAttributeManager;

use Laravel\Nova\ResourceTool;

class ProductAttributeManager extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Product Attribute Manager';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'product-attribute-manager';
    }
}
