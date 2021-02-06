<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response as R;

class Response
{
    public function handle($request, Closure $next)
    {
        /** @var R $response */
        $error = null;
        $response = $next($request);
        $original = $response->getOriginalContent();
        $code = $response->getStatusCode();

        return response()->json(
            $code > 300
                ? array_merge(['data' => null, 'success' => false, 'error' => $original])
                : ['success' => true, 'data' => $original, 'code' => 0], $code, [],
            JSON_UNESCAPED_SLASHES);
    }

}
