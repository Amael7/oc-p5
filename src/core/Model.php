<?php

  declare(strict_types=1);

  namespace App\Core;

  class Model
  {
    protected int $id;

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