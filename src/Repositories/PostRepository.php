<?php

namespace App\Repositories;

use App\Entities\Post;
use App\Mappers\PostMapper;

class PostRepository
{
  private $postMapper;
  public function __construct(PostMapper $postMapper)
  {
    $this->postMapper = $postMapper;
  }


  public function insert(object $data)
  {
    $postStatus = $this->postMapper->insert($data);
    return $postStatus;
  }
  public function update(object $data)
  {
    $post = $this->postMapper->update($data);
  }
  public function find(int $id)
  {
    $post = $this->postMapper->find($id);
    return $post;
  }

  public function findAll(): array
  {
    $posts = $this->postMapper->findAll();
    return $posts;
  }
  public function findByPage(int $page): array
  {
    $posts = $this->postMapper->findByPage($page);
    return $posts;
  }
  public function delete(object $id)
  {
    $post = $this->postMapper->delete($id);
  }

  public function countArray()
  {
    return $this->postMapper->countArray();
  }

  public function findPostsGenres(Post $post)
  {
    return $this->postMapper->findPostsGenres($post);
  }
}
