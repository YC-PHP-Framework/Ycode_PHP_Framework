<?php

namespace Yc\App\Http\Middleware;

use Yc\App\Exceptions\ForbiddenException;
use Yc\framework\App;
use Yc\framework\Middlware\Middleware;

class AuthMiddleware extends Middleware
{
    public array $middlewares = [];

    public function __construct(array $middlewares = [])
    {
        $this->middlewares = $middlewares;
    }
    public function execute()
    {
        if (true) {
            if (empty($this->middlewares)) {

                throw new ForbiddenException();
            }
        }
    }
}
