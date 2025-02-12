<?php

class Router
{
    public $routes = [];

    public function addRoute($route, $controller, $action)
    {
        $this->routes[$route] = ['controller' => $controller, 'action' => $action];
    }

    public function dispatch($url) {
        if (array_key_exists($url, $this->routes)) {
            $controller = $this->routes[$url]['controller'];
            $action = $this->routes[$url]['action'];

            $controller = new $controller();
            $controller->runAction($action);
        } else {
            throw new \Exception("No route found for URL: $url");
        }
    }
}
