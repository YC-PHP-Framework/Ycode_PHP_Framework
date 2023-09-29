<?php

namespace Yc\framework;

use Yc\framework\Middleware;

class Router 
{

    private static $routes = [];

    private const METHOD_GET = "GET";
    private const METHOD_POST = "POST";
    private const METHOD_PUT = "PUT";
    private const METHOD_PATCH = "PATCH";
    private const METHOD_DELETE = "DELETE";


    private static function middleware(string $method, string $path, array|string $middlewares = null)
    {
        if (isset($middlewares)) {
            self::$routes[$method]["middlewares"][] =
                [
                    "action" => $middlewares,
                    "method" => self::METHOD_GET,
                    "path" => $path
                ];
        }
    }

    public static function get(string $path, array|callable $controller, array|string  $middlewares = null)
    {
        self::$routes[self::METHOD_GET][$path] = $controller;
        self::middleware(self::METHOD_GET, $path, $middlewares);
    }



    public static function post(string $path, array|callable  $controller, array|string  $middlewares = null)
    {
        self::$routes[self::METHOD_POST][$path] = $controller;
        self::middleware(self::METHOD_POST, $path, $middlewares);
    }

    public static function put(string $path, array|callable  $controller)
    {
        self::$routes[self::METHOD_PUT][$path] = $controller;
    }

    public static function patch(string $path, array|callable $controller)
    {
        self::$routes[self::METHOD_PATCH][$path] = $controller;
    }


    public static function delete(string $path, array|callable $controller)
    {
        self::$routes[self::METHOD_DELETE][$path] = $controller;
    }



    public function resolve()
    {
        $path = Request::get_path();
        $method = Request::get_method();
        $controller = self::$routes[$method][$path] ?? false;
        $middlewares = self::$routes[$method]["middlewares"] ?? false;

        if (!$controller) {
            Response::httpStatusCode(Response::HTTP_NOT_FOUND);
            return abort(Response::HTTP_NOT_FOUND, $path);
        } else {

            if ($middlewares) {
                foreach ($middlewares as $middleware) {
                    if ($middleware["path"]  ===  $path) {
                        if(is_array($middleware["action"])){
                            foreach($middleware["action"] as $action){
                                    $handler = (new Container())->get(Middleware::middlewares[$action]);
                                    $handler->handle();
                            }
                        }else{
                            $handler = (new Container())->get(Middleware::middlewares[$middleware["action"]]);
                            $handler->handle();
                        }
                    }
                }
            }

            if (is_array($controller)) {
                $controller[0] = (new Container())->get($controller[0]);
            }

            // if there is any args , We are passing it  by the Request Class 
            return call_user_func($controller, new Request());
        }
    }
}
