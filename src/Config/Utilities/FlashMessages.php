<?php

# namespace App\Core\Helpers;

/**
 * Class FlashMessage
 *
 */

namespace App\Config\Utilities;

class FlashMessage
{
  const SESSION_KEY = "flash-message";

  public static function get(string $key, $defaultValue = '')
  {

    $value = $_SESSION[self::SESSION_KEY][$key] ?? $defaultValue;
    self::unset($key);
    return $value;
  }

  public static function set(string $key, $value)
  {
    $_SESSION[self::SESSION_KEY][$key] = $value;
  }

  public static function unset(string $key)
  {
    unset($_SESSION[self::SESSION_KEY][$key]);
  }
}
