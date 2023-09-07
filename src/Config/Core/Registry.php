<?php

declare(strict_types=1);

namespace App\Config\Core;





//use InvalidArgumentException;

use Exception;
use PDO;

abstract class Registry
{
  public const LOGGER = 'logger';
  public const SESSION = 'session';
  public const ROUTER = 'router';

  private static array $services = [];

  private static array $allowedKeys = [
    self::SESSION,
    self::LOGGER,
    self::ROUTER
  ];

  public static function set(string $key, $value)
  {
    if (!in_array($key, self::$allowedKeys)) {
      throw new Exception('Invalid key given');
    }

    self::$services[$key] = $value;
  }

  public static function get(string $key)
  {
    if (!in_array($key, self::$allowedKeys) || !isset(self::$services[$key])) {
      throw new Exception('Invalid key given');
    }
    return self::$services[$key];
  }
}
