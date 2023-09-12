<?php

namespace Yc\framework;

use BadMethodCallException;
use Yc\framework\Middlware\Middleware;

class Controller extends Renderable
{


    // protected Request $request;
    protected Container $container;


    public function __construct()
    {
        $this->container = new Container();
    }

    /**
     * @var \Yc\framework\Middlware\Middleware
     */
    protected array $middlewares = [];

   

    public function __call($method, $parameters)
    {
        throw new BadMethodCallException(sprintf(
            'Method %s::%s does not exist.', static::class, $method
        ));
    }

   
    public function get_request(string $key)
    {
        if (isset(Request::all()[$key])) {
            return Request::all()[$key];
        } else {
            Response::httpStatusCode(406);
            return "The key '{$key}' is not defined .";
        }
    }

    public function registerMiddleware(Middleware $middleware){
        $this->middlewares[] = $middleware;
    }
}
