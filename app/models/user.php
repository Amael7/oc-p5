<?php

declare(strict_types=1);

namespace App\Model;

class User
{
  public int $id;
  public string $first_name;
  public string $last_name;
  public string $email;
  public string $password;
  public bool $admin = false;
  public string $description;

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

$user = new User;
$user->first_name = 'Steph';
$user->last_name = 'Mon';

$fullname = $user->getFullName();

var_dump($fullname);