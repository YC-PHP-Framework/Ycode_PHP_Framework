<?php

namespace Yc\framework;

class Response
{

    public const  HTTP_OK = 200;
    public const  HTTP_CREATED = 201;
    public const  HTTP_ACCEPTED = 202;
    public const  HTTP_NO_CONTENT = 204;
    public const  HTTP_BAD_REQUEST = 400;
    public const  HTTP_FORBIDDEN = 403;
    public const  HTTP_NOT_FOUND = 404;

    public static function redirect($route)
    {
        header('Location : ' . $route);

        exit("Didn't work");
    }

    static function httpStatusCode($code)
    {
        return http_response_code($code);
    }


    static function json($data, $status)
    {
    }
}
