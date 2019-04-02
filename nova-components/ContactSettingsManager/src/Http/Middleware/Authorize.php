<?php

namespace Jmp\ContactSettingsManager\Http\Middleware;

use Laravel\Nova\Nova;
use Jmp\ContactSettingsManager\ContactSettingsManagerTool;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        // Removed this code that was built with the artisan nova tool builder
        //$tool = collect(Nova::registeredTools())->first([$this, 'matchesTool']);
        //return optional($tool)->authorize($request) ? $next($request) : abort(403);

        return resolve(ContactSettingsManagerTool::class)->authorize($request) ? $next($request) : abort(403);
    }

    /**
     * Determine whether this tool belongs to the package.
     *
     * @param \Laravel\Nova\Tool $tool
     * @return bool
     */
    public function matchesTool($tool)
    {
        return $tool instanceof ContactSettingsManager;
    }
}
