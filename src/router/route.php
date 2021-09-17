<?php

  namespace App\Router;

  // Class Route to manage routes to show views
  class Route {

    private $path;
    private $callable;
    private $params = [];
    private $matches = [];

    /**
     * method called when we create an instance of Route who 
     *
     * @param [type] $path
     * @param [type] $callable
     */
    public function __construct($path, $callable)
    {
      $this->path = trim($path, '/');
      $this->callable = $callable;
    }

    /**
     *  function to give params when we call a route in the router.rb
     *
     * @param [type] $param
     * @param [type] $regex
     * @return void
     */
    public function with($param, $regex)
    {
      $this->params[$param] = str_replace('(', '(?:', $regex);

      return $this; // On retourne tjrs l'objet pour enchainer les arguments
    }

    /**
     * Function who return true if the url has matched
     *
     * @param [type] $url
     * @return void
     */
    public function match($url)
    {
      $url = trim($url, '/');
      $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
      $regex = "#^$path$#i";
      if (!preg_match($regex, $url, $matches)) {
          return false;
      }
      array_shift($matches);
      $this->matches = $matches;

      return true;
    }

    /**
     * function who return the params matched
     *
     * @param [type] $match
     * @return void
     */
    private function paramMatch($match)
    {
      if (isset($this->params[$match[1]])) {
          return '('.$this->params[$match[1]].')';
      }

      return '([^/]+)';
    }

    /**
     * function who call a route
     *
     * @return void
     */
    public function call()
    {
      if (is_string($this->callable)) {
        $params = explode('#', $this->callable);
        // list($controller, $function) = explode('#', $this->callable);
        // $controller = 'App\\Controller\\' . $controller;
        $controller = 'App\\Controllers\\' . $params[0];
        $controller = new $controller();
        return call_user_func_array([$controller, $params[1]], $this->matches);
      }

      return call_user_func_array($this->callable, $this->matches);
    }

    /**
     * function to get the Url
     *
     * @param [type] $params
     * @return void
     */
    public function getUrl($params)
    {
      $path = $this->path;
      foreach ($params as $k => $v) {
        $path = str_replace(":$k", $v, $path);
      }

      return $path;
    }
}