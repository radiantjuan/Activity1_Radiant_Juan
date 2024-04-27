<?php
/**
 * Routes base configuration
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Config\Routes;

use App\Utilities\DebugHelper;

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

    /**
     * Route dispatcher is the heart of the application routing
     *
     * @param string $method Request method type
     * @param string $uri    URI
     *
     * @return void
     */
    public static function dispatch($method, $uri)
    {
        foreach (self::$routes as $route) {

            list($routeMethod, $routeUri, $controller, $functionName) = $route;
            // Check if method and URI match

            if ($method === $routeMethod && self::matchUri($routeUri, $uri)) {
                $url_params = self::extractUrlParams($routeUri, $uri);

                $postData = [];
                if (in_array($method, ['POST', 'PUT', 'PATCH', 'DELETE'])) {
                    $postData = $_POST;
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

    /**
     * Validation if URI is valid
     *
     * @param string $pattern URL Pattern
     * @param string $uri     URI
     *
     * @return bool|int
     */
    protected static function matchUri($pattern, $uri)
    {
        // Extract path from URI (remove query parameters)
        $uriParts = explode('?', $uri, 2);
        $uriPath = $uriParts[0];

        // Exact match
        if ($pattern === $uriPath) {
            return true;
        }

        // Parameter match
        $pattern = preg_replace('#{[\w\W\d\D]+}#', '([\w\W\d\D]+)', $pattern);
        $pattern = '#^' . $pattern . '$#';

        return preg_match($pattern, $uriPath);
    }


    /**
     * URL parameters extractor
     * Usage: /posts/{extracts_this_parameter_to_array}
     *
     * @param string $pattern URL pattern
     * @param string $uri     URI
     *
     * @return array
     */
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
