<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforceJsonResponse
{
    /**
     * Force Accept header to application/json on API routes.
     *
     * @param  Request  $request
     * @param  Closure(Request): Response  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->route()?->middleware() && in_array('api', $request->route()->middleware(), true)) {
            $request->headers->set('Accept', 'application/json');
        }

        return $next($request);
    }
}
