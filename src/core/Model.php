<?php

  declare(strict_types=1);

  namespace App\Core;

  class Model
  {
    protected int $id;

    /**
     * Set the id value
     *
     * @param integer $id
     * @return integer
     */

    public function setId(int $id): int
    {
      return $this->id = $id;
    }
    
    /**
     * Get the id value
     *
     * @return integer
     */
    public function getId(): int
    {
      return $this->id;
    }
  }