<?php

namespace App\Middlewares;

use Src\Server\RequestServer;
use Src\Server\MiddlewareServer;

class AuthMiddleware extends MiddlewareServer
{
    public function handle(RequestServer $request, $next)
    {
        return $next($request);
    }
}