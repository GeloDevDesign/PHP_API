<?php

namespace Core;

class Router
{
    protected static $routes = [];

    public static function add($method, $uri, string $controllerString)
    {
       
        $parts = explode('@', $controllerString);
        $controllerClass = "Controller\\" .$parts[0];
        $controllerMethod = $parts[1] ?? 'index'; 

        $controller = App::container()->resolve($controllerClass);
        $callable = [$controller, $controllerMethod];

        self::$routes[] = [
            'uri' => $uri,
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
