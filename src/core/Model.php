<?php

  declare(strict_types=1);

  namespace App\Core;

  class Model
  {
    protected int $id;
    protected string $created_at;
    protected string $updated_at;

    /**
     * Set the id value
     *
     * @param integer $id
     * @return integer
     */

    protected function setId(int $id): int
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

    /**
     * Set the created_at value
     *
     * @param integer $created_at
     * @return integer
     */

    protected function setCreatedAt(string $created_at): string
    {
      return $this->created_at = $created_at;
    }
    
    /**
     * Get the created_at value
     *
     * @return integer
     */
    public function getCreatedAt(): string
    {
      return $this->created_at;
    }

    /**
     * Set the updated_at value
     *
     * @param integer $updated_at
     * @return integer
     */

    protected function setUpdatedAt(string $updated_at): string
    {
      return $this->updated_at = $updated_at;
    }
    
    /**
     * Get the updated_at value
     *
     * @return integer
     */
    public function getUpdatedAt(): string
    {
      return $this->updated_at;
    }
  }