<?php

  declare(strict_types=1);

  namespace App\Core;

  class Model
  {
    public int $id;

    // Function to increment the id when an instance is create
    // public function __construct($id)
    // {
    //   $this->id = $id;
    // }

    // Set the id value
    public function setId(int $id): int
    {
      return $this->id = $id;
      
      return $this;
    }
    
    // Get the id value
    public function getId(): int
    {
      return $this->id;
    }
  }