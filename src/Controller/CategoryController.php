<?php

namespace App\Controller;

use App\Config\Core\Content;
use App\Repositories\CategoriesRepository;
use App\Mappers\CategoriesMapper;
use Symfony\Component\HttpFoundation\Response;

class CategoryController
{

  private $categoryRepository;
  public function __construct()
  {
    $this->categoryRepository = new CategoriesRepository(new CategoriesMapper());
  }
  public function index(string $slug)
  {
    $category = $this->categoryRepository->getCategory($slug);
    $category = $this->categoryRepository->searchByCategories($category);
    $content = Content::setContent('categoryListOfPost', 'main', compact('category'));
    return new Response($content);
  }
}
