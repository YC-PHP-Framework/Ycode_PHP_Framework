<?php

namespace Yc\framework;

use Yc\App\Http\Middleware\AuthMiddleware;
use Yc\App\Http\Middleware\GuestMiddleware;

/*
* difination : 
* Middleware in PHP is a layer of actions / callables that are wrapped around a piece of core logic
* in an application. These middlewares provide the ability to change either the input or the output
* of this logic. So they "live" between the input and the output, right in the middle.

* Types of middleware :
* there are actually two common types of middleware: Single Pass Middleware & Double Pass Middleware.
*/

abstract class Middleware
{

    const middlewares = [
        'guest' => GuestMiddleware::class,
        'auth' => AuthMiddleware::class

    ];
    abstract public function handle();
}
