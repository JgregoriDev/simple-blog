<?php

namespace App\Mappers;

use App\Config\Core\Connection;
use App\Config\Interfaces\MapperInterface;
use App\Entities\User;
use App\Models\UserRepository;
use DateTime;
use DateTimeImmutable;
use PDO;

class UserMapper extends Connection
{

  public function __construct()
  {
    parent::__construct();
  }

  public function login(string $data)
  {
    $stmt = $this->getPdo()->prepare("SELECT username, password_hash,role FROM users WHERE username = :username");
    $stmt->bindParam(":username", $data);
    $stmt->execute();
    $userSTD = $stmt->fetch(PDO::FETCH_OBJ);
    var_dump($userSTD);
    $user = new User();
    $user->setUsername($userSTD->username);
    $user->setPasswordHash($userSTD->password_hash);
    $user->setRole($userSTD->role);
    return $user;
  }
  public function getIDUser(string $data)
  {
    $stmt = $this->getPdo()->prepare("SELECT user_id FROM users WHERE username = :username");
    $stmt->bindParam(":username", $data);
    $stmt->execute();
    $userSTD = $stmt->fetch(PDO::FETCH_OBJ);


    return $userSTD->user_id;
  }

  public function insertComment(object $data)
  {
    $user_id = (int)$data->user_id;
    $post_id = (int)$data->post_id;
    $stmt = $this->getPdo()->prepare("INSERT INTO comments (user_id, post_id, content) VALUES (:user_id, :post_id, :comment)");
    $stmt->bindParam(":user_id", $user_id);
    $stmt->bindParam(":post_id", $post_id);
    $stmt->bindParam(":comment", $data->comment);
    $stmt->execute();
  }
  public function registerUser(string $username, string $password)
  {
    $date = new DateTimeImmutable();
    $date = $date->format("Y-m-d");
    $role = json_encode(["ROLE_USER"], true);
    $stmt = $this->getPdo()->prepare("INSERT INTO users (username, password_hash, email, created_at, role)
    VALUES (:username, :password, :email, :created_at,:role)");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $username);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":created_at", $date);
    $stmt->bindParam(":role", $role);
    return $stmt->execute();
  }
}
