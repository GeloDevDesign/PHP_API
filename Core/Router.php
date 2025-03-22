<?php

namespace Core;

class Router
{
    protected static $routes = [];

    public static function add($method, $uri, $controller)
    {
        self::$routes[] = [
            'uri' => $uri,
            'controller' => $controller,
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

    public static function put($uri, $controller)
    {
        self::add('PUT', $uri, $controller);
    }

    public static function delete($uri, $controller)
    {
        self::add('DELETE', $uri, $controller);
    }

    public  static  function all()
    {
        
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
