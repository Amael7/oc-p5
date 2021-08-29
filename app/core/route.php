<?php

  namespace App\Core;

  // Class Route to manage routes to show views
  class Route {

    private $path;
    private $callable;
    private $params = [];
    private $matches = [];

    public function __construct($path, $callable)
    {
      $this->path = trim($path, '/');
      $this->callable = $callable;
    }
  }