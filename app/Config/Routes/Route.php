<?php

namespace App\Config\Routes;

class Route
{
    protected static $routes = [];

    public static function get($uri, $controller, $method)
    {
        self::$routes[] = ['GET', $uri, $controller, $method];
    }

    public static function post($uri, $controller, $method)
    {
        self::$routes[] = ['POST', $uri, $controller, $method];
    }

    public static function patch($uri, $controller, $method)
    {
        self::$routes[] = ['PATCH', $uri, $controller, $method];
    }

    public static function put($uri, $controller, $method)
    {
        self::$routes[] = ['PUT', $uri, $controller, $method];
    }

    public static function delete($uri, $controller, $method)
    {
        self::$routes[] = ['DELETE', $uri, $controller, $method];
    }

    public static function dispatch($method, $uri)
    {
        foreach (self::$routes as $route) {
            list($routeMethod, $routeUri, $controller, $functionName) = $route;

            // Check if method and URI match
            if ($method === $routeMethod && self::matchUri($routeUri, $uri)) {
                $url_params = self::extractUrlParams($routeUri, $uri);

                if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
                    $postData = file_get_contents('php://input');
                } else {
                    $postData = [];
                }

                $request_data = array_merge($postData, $url_params);

                // Call the controller method
                $controllerInstance = new $controller();
                $controllerInstance->$functionName($request_data);

                // Stop further processing
                return;
            }
        }

        // Route not found
        http_response_code(404);
        echo "404 Not Found";
    }

    protected static function matchUri($pattern, $uri)
    {
        // Exact match
        if ($pattern === $uri) {
            return true;
        }

        // Parameter match
        $pattern = preg_replace('#{[a-zA-Z0-9]+}#', '([a-zA-Z0-9-]+)', $pattern);
        $pattern = '#^' . $pattern . '$#';

        return preg_match($pattern, $uri);
    }

    protected static function extractUrlParams($pattern, $uri)
    {
        // Extract URL parameters
        $params = [];
        $patternParts = explode('/', $pattern);
        $uriParts = explode('/', $uri);

        foreach ($patternParts as $key => $part) {
            if (strpos($part, '{') !== false && isset($uriParts[$key])) {
                $paramName = trim($part, '{}');
                $params[$paramName] = $uriParts[$key];
            }
        }

        return $params;
    }
}
