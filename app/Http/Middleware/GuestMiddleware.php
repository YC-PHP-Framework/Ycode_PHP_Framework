<?php

namespace Yc\App\Http\Middleware;

use Exception;
use Yc\App\Exceptions\ForbiddenException;
use Yc\framework\Middleware;

class GuestMiddleware extends Middleware
{

    public function handle()
    {
        if (!isset($_SESSION['user'])) {

            // header('Location : /');
            // echo ' Here  from Guest';
            // redirect('/');
            dd("Hello from Guest");
            // throw new Exception("Here");
        } else {
            throw new ForbiddenException();
        }
    }
}
