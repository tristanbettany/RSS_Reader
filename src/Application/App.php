<?php

namespace RSSReader\Application;

use RSSReader\Application\Helpers\Config;
use RSSReader\ApplicationInterface\Request;
use RSSReader\ApplicationInterface\Router;

/**
 * App Class
 */
final class App
{
    /** @var array */
    private $config;
    /** @var array */
    private $routes;
    /** @var Request */
    private $request;
    /** @var Router */
    private $router;

    /**
     * App constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->setConfig();
        $this->boot();
    }

    /**
     * Setup the config for the app
     */
    private function setConfig()
    {
        new Config($this->config);
        $this->routes = Config::get('routes');
    }

    /**
     * Bootstrap the app
     */
    private function boot()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);

        $this->router->setupRoutes($this->routes);
        $this->router->dispatch();
    }
}