<?php

namespace App\Http\Middleware;
use Closure;

use Ramsey\Uuid\Uuid;

class RequestId
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $uuid = $request->headers->get('X-Request-ID');
        if (is_null($uuid)) {
            $uuid = Uuid::uuid4()->toString();
            $request->headers->set('X-Request-ID', $uuid);
        }
        $response = $next($request);
        $response->headers->set('X-Request-ID', $uuid);
        return $response;
    }
}
