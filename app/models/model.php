<?php

  declare(strict_types=1);

  namespace App\Model;

  class Model
  {
    public int $id;

    // Set the id value
    public function setId($id): int
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