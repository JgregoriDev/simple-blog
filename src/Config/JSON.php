<?php

namespace App\Config;

class JSON
{
  protected $jsonFile;

  public function __construct(string $jsonFilePath = "./data.json")
  {
    $fileJSON = file_get_contents(__DIR__ . "/$jsonFilePath");
    $this->jsonFile = json_decode($fileJSON, true);
  }

  public function getDSN(): string
  {
    return $this->jsonFile["dsn"];
  }
  public function get(string $key): string
  {
    return $this->jsonFile[$key];
  }
}
