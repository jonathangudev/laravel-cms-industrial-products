<?php

namespace Jmp\Company\Http\Middleware;

use Jmp\Company\Company;

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
        return resolve(Company::class)->authorize($request) ? $next($request) : abort(403);
    }
}
