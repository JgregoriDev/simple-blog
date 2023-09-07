<?php

namespace App\Config\Core;

class Session
{

  public function __construct()
  {
    session_start();
  }

  public function set($key, $value)
  {
    $_SESSION[$key] = $value;
  }
  public function get($key)
  {
    return $_SESSION[$key] ?? '';
  }

  public function destroy($key)
  {
    unset($_SESSION[$key]);
    session_destroy();
  }
}
