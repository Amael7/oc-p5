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
    private string $tokenEmailRecuperation;
    private string $tokenAuth;
    private string $tokenAdmin;
    private bool $admin = false;
    private string $description;

    /**
     * Get the full name of a user
     *
     * @return string
     */
    public function getFullName(): string
    {
      return $this->last_name . ' ' . $this->first_name;
    }
    
    /**
     * Set the first_name value
     *
     * @param string $first_name
     * @return string
     */
    public function setFirstName(string $first_name): string
    {
      return $this->first_name = $first_name;
      
      return $this;
    }
    
    /**
     * Get the first_name value
     *
     * @return string
     */
    public function getFirstName(): string
    {
      return $this->first_name;
    }
    
    /**
     * Set the last_name value
     *
     * @param string $last_name
     * @return string
     */
    public function setLastName(string $last_name): string
    {
      return $this->last_name = $last_name;
      
      return $this;
    }
    
    /**
     * Get the last_name value
     *
     * @return string
     */
    public function getLastName(): string
    {
      return $this->last_name;
    }

    /**
     * Set the email value
     *
     * @param string $email
     * @return string
     */
    public function setEmail(string $email): string
    {
      return $this->email = $email;
      
      return $this;
    }
    
    /**
     * Get the email value
     *
     * @return string
     */
    public function getEmail(): string
    {
      return $this->email;
    }

    /**
     * Set the password value
     *
     * @param string $password
     * @return string
     */
    public function setPassword(string $password): string
    {
      return $this->password = $password;
      
      return $this;
    }
    
    /**
     * Get the password value
     *
     * @return string
     */
    public function getPassword(): string
    {
      return $this->password;
    }

    /**
     * Set the description value
     *
     * @param string $description
     * @return string
     */
    public function SetDescription(string $description): string
    {
      return $this->description = $description;
      
      return $this;
    }
    
    /**
     * Get the description value
     *
     * @return string
     */
    public function getDescription(): string
    {
      return $this->description;
    }

    /**
     * Set the admin value
     *
     * @param boolean $admin
     * @return boolean
     */
    public function SetAdmin(bool $admin): bool
    {
      return $this->admin = $admin;
      
      return $this;
    }
    
    /**
     * Get the admin value
     *
     * @return boolean
     */
    public function getAdmin(): bool
    {
      return $this->admin;
    }
    
    /**
     * Set the tokenEmailRecuperation value
     *
     * @return string
     */
    public function setTokenEmailRecuperation(): string
    {
      return $this->token_email_recuperation = uniqid();
      
      return $this;
    }

    /**
     * Get the tokenEmailRecuperation
     *
     * @return string
     */
    public function getTokenEmailRecuperation(): string
    {
      return $this->token_email_recuperation;
    }
    
    /**
     * Set the tokenAuth value
     *
     * @return string
     */
    public function setTokenAuth(): string
    {

      return $this->token_auth = uniqid();
      
      return $this;
    }

    /**
     * Get the tokenAuth of a user
     *
     * @return string
     */
    public function getTokenAuth(): string
    {
      return $this->token_auth;
    }
    
    /**
     * Set the tokenAdmin value
     *
     * @return string
     */
    public function setTokenAdmin(): string
    {
      return $this->token_admin = uniqid();
      
      return $this;
    }

    /**
     * Get the tokenAdmin of a user
     *
     * @return string
     */
    public function getTokenAdmin(): string
    {
      return $this->token_admin;
    }
  }