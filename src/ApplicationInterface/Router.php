<?php

namespace RSSReader\ApplicationInterface;

use RSSReader\ApplicationInterface\Exceptions\HttpNotFoundException;
use RSSReader\Presentation\Template;

/**
 * Router Class
 */
final class Router
{
    /** @var RequestInterface */
    private $request;
    /** @var array */
    private $routes;

    /**
     * Router constructor.
     *
     * @param RequestInterface $request
     */
    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @param $method
     * @param $arguments
     */
    public function __call(
        $method,
        $arguments
    ) {
        list($path, $action) = $arguments;

        // TODO: Given more time, parse the request uri for params to pass into the action

        $this->routes[$method][$path] = $action;
    }

    /**
     * @param array $routes
     */
    public function setupRoutes(array $routes)
    {
        foreach($routes as $routeName => $route) {
            foreach($route['methods'] as $method) {
                $method = strtolower($method);
                $this->$method(
                    $route['path'],
                    $route['action']
                );
            }
        }
    }

    /**
     * Dispatch to route
     *
     * @throws HttpNotFoundException
     */
    public function dispatch()
    {
        $method = strtolower($this->request->getRequestMethod());
        $path = $this->request->getUriPath();

        if (empty($this->routes[$method][$path]) === false) {
            $className = $this->routes[$method][$path];
            $class = new $className;
            $response = call_user_func_array(
                [
                    $class,
                    $method,
                ],
                [$this->request]
            );

            Template::render($response);
        } else {
            throw new HttpNotFoundException();
        }
    }
}