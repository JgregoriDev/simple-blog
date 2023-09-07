<?php

namespace App\Repositories;

use App\Entities\Categories;
use App\Mappers\CategoriesMapper;

class CategoriesRepository
{
  public function __construct(private CategoriesMapper $categoriesMapper)
  {
    $this->categoriesMapper = $categoriesMapper;
  }

  public function getAllCategories()
  {
    return $this->categoriesMapper->getAllCategories();
  }

  public function searchByCategories(Categories $categories): Categories
  {
    return $this->categoriesMapper->searchByCategories($categories);
  }

  public function getCategory(string $slug)
  {
    return $this->categoriesMapper->getCategory($slug);
  }
}
