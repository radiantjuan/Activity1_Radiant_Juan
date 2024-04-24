<?php

namespace App\Config\Routes;

class Route
{
    protected static $routes = [];

    public static function get($uri, $controller, $action)
    {
        self::$routes['GET'][$uri] = compact('controller', 'action');
        return new self();
    }

    public static function post($uri, $controller, $action)
    {
        self::$routes['POST'][$uri] = compact('controller', 'action');
        return new self();
    }

    // Add methods for other HTTP request methods as needed

    public static function dispatch($method, $uri)
    {
        if (isset(self::$routes[$method][$uri])) {
            $route = self::$routes[$method][$uri];
            $controller = 'App\\Controllers\\' . $route['controller'];
            $action = $route['action'];
            $controllerInstance = new $controller();
            $controllerInstance->$action();
        } else {
            http_response_code(404);
            echo '404 Not Found';
        }
    }
}
