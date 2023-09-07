<?php

namespace App\Mappers;

use App\Config\Core\Connection;
use App\Config\Interfaces\MapperInterface;
use App\Entities\Comment;
use App\Entities\Post;
use PDO;
use PDOException;

class PostMapper extends Connection implements MapperInterface
{
  public const LIMIT = 6;

  public function __construct()
  {
    parent::__construct();
  }
  public function find(int|string  $uuid): object|bool
  {
    $stmt = $this->getPdo()->prepare("SELECT COUNT(*) as size FROM comments c WHERE post_id = :uuid");
    $stmt->bindParam(":uuid", $uuid);
    $stmt->execute();
    $data = $stmt->fetch();
    $sizeArrayMessages = $data["size"];
    $sql = $sizeArrayMessages === 0  ? "SELECT p.post_id, p.image,p.user_id, p.content, p.created_at FROM posts p  WHERE p.post_id = :uuid"
      : "SELECT p.image,p.post_id, p.user_id, p.content, p.created_at, c.comment_id as pk_comment,c.content as comment, c.created_at as dateComment, c.user_id as userId FROM posts p
    INNER JOIN comments c
    ON c.post_id = p.post_id
    WHERE p.post_id = :uuid";
    $stmt = $this->getPdo()->prepare($sql);
    $stmt->bindParam(":uuid", $uuid);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    $post = new Post();
    $post->setImage($data[0]?->image ?? null);
    $post->setPostId($data[0]->post_id);
    $post->setUserId($data[0]->user_id);
    $post->setContent($data[0]->content);
    $post->setCreatedAt($data[0]->created_at);
    if ($sizeArrayMessages > 0) {
      $arrayAux = [];
      foreach ($data as $commentSTD) {
        $comment = new Comment();
        $comment->setCommentId($commentSTD->pk_comment);
        $comment->setContent($commentSTD->comment);
        $comment->setCreatedAt($commentSTD->dateComment);
        $comment->setUserId($commentSTD->userId);
        $arrayAux[] = $comment;
      }
      $post->setComments($arrayAux);
    }
    return $post;
  }

  public function findAll(): array
  {
    $stmt = $this->getPdo()->prepare("SELECT * FROM posts LIMIT 10");
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    $arrayPost = [];
    var_dump($data);
    foreach ($data as $postSTD) {
      $post = new Post();
      $post->setPostId($postSTD->post_id)
        ->setUserId($postSTD->user_id)
        ->setImage($postSTD->image ?? null)
        ->setContent($postSTD->content)
        ->setCreatedAt($postSTD->created_at);
      $arrayPost[] =  $post;
    }

    return $arrayPost;
  }
  public function findByPage(int $page): array
  {
    $index = $page * self::LIMIT;
    $stmt = $this->getPdo()->prepare("SELECT * FROM posts LIMIT 10 OFFSET :limit");
    $stmt->bindParam(":limit", $index);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    $arrayPost = [];
    foreach ($data as $postSTD) {
      $post = new Post();
      $post->setPostId($postSTD->post_id);
      $post->setUserId($postSTD->user_id);
      $post->setImage($postSTD->image ?? null);
      $post->setContent($postSTD->content);
      $post->setCreatedAt($postSTD->created_at);
      $arrayPost[] =  $post;
    }
    return $arrayPost;
  }

  /**
   *
   * @param Post $data
   * @return void
   * @throws PDOException
   */
  public function insert(object $data)
  {
    $userId = $data->getUserId();
    $content = $data->getContent();
    $date = $data->getCreatedAt();
    $image = $data->getImage();
    $stmt = $this->getPdo()->prepare("INSERT INTO posts (user_id, image,content, created_at) VALUES (:user_id, :image,:content, :created_at)");
    $stmt->bindParam(":user_id", $userId);
    $stmt->bindParam(":image", $image);
    $stmt->bindParam(":content", $content);
    $createdAt = $date->format("Y-m-d H:i:s");
    $stmt->bindParam(":created_at", $createdAt);
    $results = ["status" => $stmt->execute(), "pk" => $this->getPdo()->lastInsertId()];
    return $results;
  }

  public function update(object $data)
  {
  }

  public function delete(object $data)
  {
    $stmt = $this->getPdo()->prepare("DELETE FROM posts WHERE post_id = :id");
    $stmt->bindParam(":id", $data->id);
    $stmt->execute();
  }
  # code...
}
