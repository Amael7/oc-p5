<?php

  namespace App\Router;

  // Class Router to manage routes to show views
  class Router {

    private $url;
    private $routes = [];
    private $namedRoutes = [];

    /**
     * function called when an instance of Router is created
     *
     * @param [type] $url
     */
    public function __construct($url)
    {
      $this->url = $url;
    }

    /**
     * function to set a Get method request
     *
     * @param [type] $path
     * @param [type] $callable
     * @param [type] $name
     * @return void
     */
    public function get($path, $callable, $name = null)
    {
      return $this->add($path, $callable, $name, 'GET');
    }

    /**
     * function to set a Post method request
     *
     * @param [type] $path
     * @param [type] $callable
     * @param [type] $name
     * @return void
     */
    public function post($path, $callable, $name = null)
    {
      return $this->add($path, $callable, $name, 'POST');
    }

    /**
     * function to add an new route
     *
     * @param [type] $path
     * @param [type] $callable
     * @param [type] $name
     * @param [type] $method
     * @return void
     */
    private function add($path, $callable, $name, $method)
    {
      $route = new Route($path, $callable);
      $this->routes[$method][] = $route;
      if (is_string($callable) && $name == null) {
        $name = $callable;
      }
      if ($name) {
        $this->namedRoutes[$name] = $route;
      }

      return $route;
    }

    /**
     * function to run the router
     *
     * @return void
     */
    public function run()
    {
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            throw new \Exception('REQUEST_METHOD does not exist');
        } 
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) {
                return $route->call();
            }
        }
        throw new \Exception('No matching routes');
    }
    
    /**
     * function to check the url 
     *
     * @param [type] $name
     * @param array $params
     * @return void
     */
    public function url($name, $params = [])
    {
        if (!isset($this->namedRoutes[$name])) {
            throw new \Exception('No route matches this name');
        }

        return $this->namedRoutes[$name]->getUrl($params);
    }
  }

