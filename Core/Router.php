<?php
namespace Core;

class Router
{
    protected static $routes = [];

    public static function add($method, $uri, string $controllerClass, string $controllerMethod)
    {
        $controller = App::container()->resolve($controllerClass);
        $callable = [$controller, $controllerMethod];
        //SAMPLE OUTPUT:  Controller\NoteController  , index

        self::$routes[] = [
            'uri' => $uri,
            'controller' => $callable,
            'method' => $method
        ];
    }

    // public static function add($method, $uri, $controller)
    // {
    //     self::$routes[] = [
    //         'uri' => $uri,
    //         'controller' => $controller,
    //         'method' => $method
    //     ];
    // }


    public static function get($uri, $controllerClass, $controllerMethod)
    {
        self::add('GET', $uri, $controllerClass, $controllerMethod);
    }

    public static function post($uri, $controllerClass, $controllerMethod)
    {
        self::add('POST', $uri, $controllerClass, $controllerMethod);
    }

    public static function patch($uri, $controllerClass, $controllerMethod)
    {
        self::add('PATCH', $uri, $controllerClass, $controllerMethod);
    }

    public static function delete($uri, $controllerClass, $controllerMethod)
    {
        self::add('DELETE', $uri, $controllerClass, $controllerMethod);
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