<?php

namespace Core;




class Router
{
    protected static $routes = [];

    public static function add($method, $uri, string $controllerString)
    {

        $parts = explode('@', $controllerString);
        $controllerClass = "Controller\\" . $parts[0];
        $controllerMethod = $parts[1] ?? 'index';

        $controller = App::container()->resolve($controllerClass);
        $callable = [$controller, $controllerMethod];

        self::$routes[] = [
            'uri' => self::parseRoute($uri),
            'controller' => $callable,
            'method' => $method
        ];
    }


    public static function get($uri, $controller)
    {
        self::add('GET', $uri, $controller);
    }

    public static function post($uri, $controller)
    {
        self::add('POST', $uri, $controller);
    }

    public static function patch($uri, $controller)
    {
        self::add('PATCH', $uri, $controller);
    }

    public static function delete($uri, $controller)
    {
        self::add('DELETE', $uri, $controller);
    }

   public static function getRouteParam()
    {
        $url = parse_url($_SERVER['REQUEST_URI'])['path'];
        $last = strpos($url, '/');
        $endPosition = strrpos($url, '/', $last);
        $id = substr($url, $endPosition + 1);
        return $id;
    }
    public  static function parseRoute($route)
    {
        $start = strpos($route, "{");

        $end = strpos($route, "}");

        if (!strpos($route, "{")) {
            return $route;
        }

        $length = $end - $start + 1;

        return $endpoint =  substr_replace($route, self::getRouteParam(), $start, $length);
    }



    public static function route($uri, $method)
    {
        foreach (self::$routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                if (is_callable($route['controller'])) {
                    return call_user_func($route['controller']);
                }
                echo "Invalid controller";
                return;
            }
        }
        echo "404 not found";
    }
}
