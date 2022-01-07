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
     * @return 
     */

    protected function setCreatedAt(string $created_at): string
    {
      return $this->created_at = $created_at;
    }
    
    /**
     * Get the created_at value
     *
     * @return 
     */
    public function getCreatedAt(): string
    {
      return $this->created_at;
    }

    /**
     * Set the updated_at value
     *
     * @param integer $updated_at
     * @return 
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

    /**
     * function to display a datetime as a string with the good format
     *
     * @param string $datetime
     * @return string
     */
    public function displayDateTime(string $datetime, $hour = true) {
      $year = substr($datetime, 0, 4);
      $month = substr($datetime, 5, 2);
      $day = substr($datetime, 8, 2);
      $time = substr($datetime, 11, 8);
      if ($hour == false) {
        return "$day/$month/$year";
      } else {
        return "$day/$month/$year - $time";
      }
    }
  }