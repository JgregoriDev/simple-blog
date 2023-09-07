<?php

namespace App\Repositories;

use App\Mappers\UserMapper;
use App\Models\User;

class UserRepository
{

  private $userMapper;
  public function __construct(UserMapper $userMapper)
  {
    $this->userMapper = $userMapper;
  }
  public function login(string $data)
  {
    return $this->userMapper->login($data);
  }

  public function getUserID(string $data)
  {
    return $this->userMapper->getIDUser($data);
  }

  public function insertComment(object $data)
  {
    return $this->userMapper->insertComment($data);
  }

  public function registerUser($username, $password)
  {
    return $this->userMapper->registerUser($username, $password);
  }
}
