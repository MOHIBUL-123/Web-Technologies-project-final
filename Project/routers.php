<?php

class Router
{
    private $routes = [];

    // Add Route
    public function get($route, $action)
    {
        $this->routes['GET'][$route] = $action;
    }

    public function post($route, $action)
    {
        $this->routes['POST'][$route] = $action;
    }

    // Dispatch Route
    public function dispatch()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $requestUri = parse_url(
            $_SERVER['REQUEST_URI'],
            PHP_URL_PATH
        );

        // Project Folder Remove
        $basePath = '/Library-Management-System/Project';

        $requestUri = str_replace(
            $basePath,
            '',
            $requestUri
        );

        $requestUri = $requestUri ?: '/';

        // Route Match
        if(isset($this->routes[$requestMethod][$requestUri]))
        {
            $action =
                $this->routes[$requestMethod][$requestUri];

            [$controllerName, $method] =
                explode('@', $action);

            require_once "controllers/$controllerName.php";

            $controller = new $controllerName();

            $controller->$method();
        }
        else
        {
            echo "404 Route Not Found";
        }
    }
}