<?php

namespace Jmp\CatalogManager\Http\Middleware;

use Jmp\CatalogManager\CatalogManager;

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
        return resolve(CatalogManager::class)->authorize($request) ? $next($request) : abort(403);
    }
}
