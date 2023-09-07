<?php

namespace App\Entities;

use Webmozart\Assert\Assert;

class Comment
{
  private $comment_id;
  private $user_id;
  private $post_id;
  private $content;
  private $created_at;

  /**
   * Get the value of comment_id
   */
  public function getCommentId()
  {
    return $this->comment_id;
  }

  /**
   * Set the value of comment_id
   */
  public function setCommentId($comment_id): self
  {
    $this->comment_id = $comment_id;

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
}
