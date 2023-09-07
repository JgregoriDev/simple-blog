<?php

namespace App\Mappers;

use App\Config\Core\Connection;
use App\Entities\Categories;
use App\Entities\Post;
use PDO;

class CategoriesMapper extends Connection
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getAllCategories()
  {
    $stmt = $this->getPdo()->query("SELECT * FROM categories");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    $categories = [];
    foreach ($data as $category) {
      $categoryObject = new Categories();
      $categoryObject->setId($category->id)
        ->setNameCategory($category->category);
      $categories[] = $categoryObject;
    }
    return $categories;
  }

  public function getCategory(string $slug)
  {
    $stmt = $this->getPdo()->prepare("SELECT * FROM categories WHERE category =:category ");
    $stmt->execute([$slug]);
    $data = $stmt->fetch(PDO::FETCH_OBJ);
    $categories = new Categories();
    $categories->setNameCategory($data->category)
      ->setId($data->id);
    return $categories;
  }
  public function searchByCategories(Categories $categories): Categories
  {
    $stmt = $this->getPdo()->prepare("SELECT * FROM categories c
    INNER JOIN post_category pc on c.id = pc.id_category
    INNER JOIN posts p on pc.id_post = p.post_id
     WHERE c.id = ?");
    $stmt->execute([$categories->getId()]);
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    $arrayPosts = [];
    foreach ($data as $poststd) {
      $post = new Post();
      $post->setPostId($poststd->post_id);
      $post->setContent($poststd->content);
      $post->setImage($poststd->image);

      $arrayPosts[] = $post;
    }
    $categories->setListOfPosts($arrayPosts);
    return $categories;
  }
}
