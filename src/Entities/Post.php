<?php

namespace App\Entities;

class Post
{
  public const IMAGE_PATH = "/assets/images/";
  private $post_id;
  private $user_id;
  private $content;
  private $created_at;
  private $image;
  private $comments;
  private $categories;
  /**
   * Get the value of post_id
   */
  public function getPostId()
  {
    return $this->post_id;
  }

  /**
   * Set the value of post_id
   */
  public function setPostId($post_id): self
  {
    $this->post_id = $post_id;

    return $this;
  }

  /**
   * Get the value of user_id
   */
  public function getUserId()
  {
    return $this->user_id;
  }

  /**
   * Set the value of user_id
   */
  public function setUserId($user_id): self
  {
    $this->user_id = $user_id;

    return $this;
  }

  /**
   * Get the value of content
   */
  public function getContent()
  {
    return $this->content;
  }

  /**
   * Set the value of content
   */
  public function setContent($content): self
  {
    $this->content = $content;

    return $this;
  }

  /**
   * Get the value of created_at
   */
  public function getCreatedAt()
  {
    return $this->created_at;
  }

  /**
   * Set the value of created_at
   */
  public function setCreatedAt($created_at): self
  {
    $this->created_at = $created_at;

    return $this;
  }

  /**
   * Get the value of comments
   */
  public function getComments()
  {
    return $this->comments;
  }

  /**
   * Set the value of comments
   */
  public function setComments($comments): self
  {
    $this->comments = $comments;

    return $this;
  }

  /**
   * Get the value of image
   */
  public function getImage()
  {
    return $this->image;
  }

  /**
   * Set the value of image
   */
  public function setImage($image): self
  {
    $this->image = $image;

    return $this;
  }

  /**
   * Get the value of categories
   */
  public function getCategories()
  {
    return $this->categories;
  }

  /**
   * Set the value of categories
   */
  public function setCategories($categories): self
  {
    $this->categories = $categories;

    return $this;
  }
}
