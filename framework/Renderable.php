<?php

namespace Yc\framework;


abstract class Renderable
{


    private static function setLayout($layout = "main")
    {
        ob_start();
        include_once base_root("/resources/views/layouts/" . $layout . ".php");
        return ob_get_clean();
    }

    private static function setView($view, $params)
    {
        extract($params);
        ob_start();
        include_once base_root("/resources/views/$view.php");
        return ob_get_clean();
    }

    // in this step i am injecting the view within the layout 
    public static function view($view,  $params = [], $layout = "main")
    {
        $head = explode("/",$view);
        $head = $head[count($head)-1];
        $layout = self::setLayout($layout);
        $rendredView = self::setView($view, $params);
        $layout = str_replace('{{title}}', $head, $layout);
        return str_replace("{{content}}", $rendredView, $layout);
    }

    public static function redirect($route)
    {
        header('Location : ' . $route);
    }
}
