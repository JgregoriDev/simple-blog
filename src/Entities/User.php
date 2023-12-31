<?php

namespace App\Entities;

class User
{
  private const ROLE_USER = "[\"ROLE_USER\"]";
  private const ROLE_ADMIN = "[\"ROLE_ADMIN\",\"ROLE_USER\"]";
  private $user_id;
  private $username;
  private $email;
  private $password_hash;
  private $created_at;
  private $role;
  /**
   * Get the value of user_id
   */
  public function getUserId()
  {
    return $this->user_id;
  }

  /**
   * Set the value of user_id
   */
  public function setUserId($user_id): self
  {
    $this->user_id = $user_id;

    return $this;
  }

  /**
   * Get the value of username
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * Set the value of username
   */
  public function setUsername($username): self
  {
    $this->username = $username;

    return $this;
  }

  /**
   * Get the value of email
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set the value of email
   */
  public function setEmail($email): self
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get the value of password_hash
   */
  public function getPasswordHash()
  {
    return $this->password_hash;
  }

  /**
   * Set the value of password_hash
   */
  public function setPasswordHash($password_hash): self
  {
    $this->password_hash = $password_hash;

    return $this;
  }

  /**
   * Get the value of created_at
   */
  public function getCreatedAt()
  {
    return $this->created_at;
  }

  /**
   * Set the value of created_at
   */
  public function setCreatedAt($created_at): self
  {
    $this->created_at = $created_at;

    return $this;
  }

  /**
   * Get the value of role
   */
  public function getRole()
  {
    return $this->role;
  }

  /**
   * Set the value of role
   */
  public function setRole($role): self
  {
    var_dump(json_encode($role, true));
    $this->role = json_encode($role);

    return $this;
  }
  public function isAdmin(): bool
  {
    return $this->getRole() === self::ROLE_ADMIN;
  }
}
