<?php

namespace Jmp\LogUserLogins;

use Laravel\Nova\ResourceTool;

class LogUserLogins extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'User Logins';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'log-user-logins';
    }
}
