<?php

namespace Yc\App\Http\Middleware;

use Yc\App\Exceptions\ForbiddenException;
use Yc\framework\Middleware;

class AuthMiddleware extends Middleware
{

    public function handle()
    {
        if (!isset($_SESSION['user'])) {
            redirect("/login");
        } else {
            throw new ForbiddenException();
        }
    }
}
