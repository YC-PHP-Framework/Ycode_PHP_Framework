<?php

use Yc\framework\Renderable;
use Yc\framework\Response;

//  You can also do this 
// if (!function_exists("base_root")) {

// function base_root($destination)
// {
//     return dirname(__DIR__) . $destination;
// }
// }

function base_root($destination)
{
    return dirname(__DIR__) . $destination;
}

function redirect($route)
{
    header('Location : ' . $route, TRUE, 301);
}


function dd(mixed $data = null)
{
  
        if (is_array($data)) {
            foreach ($data as $ele) {
                echo "<pre>";
                var_dump($ele);
                echo "</pre>";
                echo "</br>";
            }
        } else {
            echo "<pre>";
            var_dump($data);
            echo "</pre>";
        }
    


    exit;
}


function abort($page = Response::HTTP_NOT_FOUND, $url = "")
{
    return Renderable::view("responses/" . $page, ["url" => $url]);
}

function authorize($condition, $status = Response::HTTP_FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

function isUri($uri)
{
    return $_SERVER['REQUEST_URI'] === $uri;
}
