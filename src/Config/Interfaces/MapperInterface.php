<?php



namespace App\Config\Interfaces;

interface MapperInterface
{
  public function find(int|string $uuid): object|bool;
  public function findAll(): array;
  public function insert(object $data);
  public function update(object $data);
  public function delete(object $data);
}
