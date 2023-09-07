<?php

namespace App\Config\Core;

class Content
{
  static public function setContent(string $template, string $layout, array $data = []): string
  {

    extract($data);

    ob_start();
    require __DIR__ . "/../../../templates/{$template}.template.php";
    $content = ob_get_clean();


    ob_start();
    require __DIR__ . "/../../../templates/layouts/{$layout}.layout.php";
    // Retorna el contingut del buffer i desactiva el buffering
    $content = ob_get_clean();

    return $content;
  }
}
