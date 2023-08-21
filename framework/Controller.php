<?php

namespace Yc\framework;


class Controller extends Renderable
{


    // protected Request $request;
    protected Container $container;
   

    public function __construct()
    {
        $this->container = new Container();
    }

    protected $middleware = [];

    public function getMiddleware(): array
    {
        return $this->middleware;
    }

    public function __call($method, $parameters)
    {
        // throw new BadMethodCallException(sprintf(
        //     'Method %s::%s does not exist.', static::class, $method
        // ));
    }

    // public function requests()
    // {
    //     return Request::requests_all();
    // }

    public function get_request(string $key)
    {
        if (isset(Request::all()[$key])) {
            return Request::all()[$key];
        } else {
            Response::httpStatusCode(406);
            return "The key '{$key}' is not defined .";
        }
    }
}
