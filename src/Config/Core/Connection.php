<?php

namespace App\Config\Core;

use App\Config\JSON;
use PDO;

class Connection
{
  private $pdo;
  public function __construct()
  {
    $json = new JSON();
    $dsn = $json->getDSN();
    $user = $json->get("user");
    $password = $json->get("password");
    $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $this->pdo = new PDO($dsn, $user, $password, $options);
  }
  /**
   * Get the value of pdo
   */
  public function getPdo()
  {
    return $this->pdo;
  }
}
