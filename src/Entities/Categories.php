<?php

namespace App\Entities;

class Categories
{
  private $id;
  private $nameCategory;
  private $listOfPosts;

  /**
   * Get the value of id
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   */
  public function setId($id): self
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of nameCategory
   */
  public function getNameCategory()
  {
    return $this->nameCategory;
  }

  /**
   * Set the value of nameCategory
   */
  public function setNameCategory($nameCategory): self
  {
    $this->nameCategory = $nameCategory;

    return $this;
  }

  /**
   * Get the value of listOfPosts
   */
  public function getListOfPosts()
  {
    return $this->listOfPosts;
  }

  /**
   * Set the value of listOfPosts
   */
  public function setListOfPosts($listOfPosts): self
  {
    $this->listOfPosts = $listOfPosts;

    return $this;
  }
}
