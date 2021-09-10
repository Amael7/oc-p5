<?php

  declare(strict_types=1);

  namespace App\Models;

  use App\Core\Model;

  class User extends Model
  {
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $password;
    private bool $admin = false;
    private string $description;

    // Get the full name of a user
    public function getFullName(): string
    {
      return $this->last_name . ' ' . $this->first_name;
    }
    
    // Set the first_name value
    public function setFirstName(string $first_name): string
    {
      return $this->first_name = $first_name;
      
      return $this;
    }
    
    // Get the first_name value
    public function getFirstName(): string
    {
      return $this->first_name;
    }
    
    // Set the last_name value
    public function setLastName(string $last_name): string
    {
      return $this->last_name = $last_name;
      
      return $this;
    }
    
    // Get the last_name value
    public function getLastName(): string
    {
      return $this->last_name;
    }

    // Set the email value
    public function setEmail(string $email): string
    {
      return $this->email = $email;
      
      return $this;
    }
    
    // Get the email value
    public function getEmail(): string
    {
      return $this->email;
    }

    // Set the password value
    public function setPassword(string $password): string
    {
      return $this->password = $password;
      
      return $this;
    }
    
    // Get the password value
    public function getPassword(): string
    {
      return $this->password;
    }

    // Set the description value
    public function SetDescription(string $description): string
    {
      return $this->description = $description;
      
      return $this;
    }
    
    // Get the description value
    public function getDescription(): string
    {
      return $this->description;
    }

    // Set the admin value
    public function SetAdmin(bool $admin): bool
    {
      return $this->admin = $admin;
      
      return $this;
    }
    
    // Get the admin value
    public function getAdmin(): bool
    {
      return $this->admin;
    }
  }