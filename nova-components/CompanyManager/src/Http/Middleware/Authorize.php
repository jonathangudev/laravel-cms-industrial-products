<?php

namespace Jmp\CompanyManager\Http\Middleware;

use Jmp\CompanyManager\CompanyManagerTool;

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
        return resolve(CompanyManagerTool::class)->authorize($request) ? $next($request) : abort(403);
    }
}
