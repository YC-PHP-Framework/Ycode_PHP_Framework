<?php

namespace Yc\framework;


class Router extends Renderable
{

    public function __construct(private ?string $method = null, private ?string $path = null)
    {
    }

    private static $routes = [];

    private const METHOD_GET = "GET";
    private const METHOD_POST = "POST";
    private const METHOD_PUT = "PUT";
    private const METHOD_PATCH = "PATCH";
    private const METHOD_DELETE = "DELETE";



    public static function get(string $path, array|callable $controller)
    {
        self::$routes[self::METHOD_GET][$path] = $controller;
        if (!is_callable($controller)) {
            return (new Router(self::METHOD_GET, $path));
        }
    }
    public function middleware($name)
    {
        self::$routes[$this->method][$this->path]["middleware"] = $name;
    }

    public static function post(string $path, array|callable  $controller)
    {
        self::$routes[self::METHOD_POST][$path] = $controller;
        if (!is_callable($controller)) {

            return (new Router(self::METHOD_POST, $path));
        }
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

        if (!$controller) { // $controller === false
            Response::httpStatusCode(Response::HTTP_NOT_FOUND);
            
            return abort(Response::HTTP_NOT_FOUND, $path);
        }

        if (is_array($controller)) {
            // EX : [0]=> "Main\app\Http\Controllers\NavigatorController" [1]=> "index" 
            // $site = new NavigatorController();
            // dd($controller);
            // $controller[0] = new $controller[0]();
            $controller[0] = (new Container())->get($controller[0]);
        }

        // if there is any args , We are passing it  by the Request Class 
        return call_user_func($controller, new Request());
    }
}
