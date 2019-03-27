<?php

namespace Jmp\ContactSettingsManager;

use Laravel\Nova\ResourceTool;

class ContactSettingsManager extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Contact Settings Manager';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'contact-settings-manager';
    }
}
