<?php

namespace Jmp\CompanyCatalogManager;

use Laravel\Nova\ResourceTool;

class CompanyCatalogManager extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Catalog';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'company-catalog-manager';
    }
}
