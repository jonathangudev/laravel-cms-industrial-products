<?php

namespace Jmp\ProductSpecSheetManager;

use Laravel\Nova\ResourceTool;

class ProductSpecSheetManager extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Product Spec Sheet Manager';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'product-spec-sheet-manager';
    }
}
