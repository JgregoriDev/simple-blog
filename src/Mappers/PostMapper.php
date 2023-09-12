<?php

namespace App\Mappers;

use App\Config\Core\Connection;
use App\Config\Interfaces\MapperInterface;
use App\Entities\Categories;
use App\Entities\Comment;
use App\Entities\Post;
use PDO;
use PDOException;

class PostMapper extends Connection implements MapperInterface
{
  public const LIMIT = 10;

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
    // var_dump($post, $data);
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

  public function findPostsGenres(Post $post)
  {
    $id = $post->getPostId();
    $stmt = $this->getPdo()->prepare("SELECT COUNT(*) as size FROM post_category pc WHERE pc.id_post = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $size = $stmt->fetchAll(PDO::FETCH_OBJ);
    if ($size > 0) {

      $stmt = $this->getPdo()->prepare("SELECT id_category, category
        FROM posts p
        INNER JOIN post_category pc ON p.post_id = pc.id_post
        INNER JOIN categories c ON pc.id_category = c.id
        WHERE p.post_id = ?;");
      $stmt->execute([$post->getPostId()]);
      $data = $stmt->fetchAll(PDO::FETCH_OBJ);
      $categories = [];
      foreach ($data as $categorySTD) {
        $category = new Categories();
        $category->setId($categorySTD->id_category);
        $category->setNameCategory($categorySTD->category);
        $categories[] = $category;
      }
      $post->setCategories($categories);
      return $post;
    }
    return false;
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
        ->setExtracto($postSTD->extracto)
        ->setUserId($postSTD->user_id)
        ->setImage($postSTD->image ?? null)
        ->setContent($postSTD->content)
        ->setCreatedAt($postSTD->created_at);
      $arrayPost[] =  $post;
    }

    return $arrayPost;
  }

  public function countArray()
  {
    $stmt = $this->getPdo()->prepare("SELECT COUNT(*) as size FROM posts LIMIT 10");
    $stmt->execute();
    $size = $stmt->fetch();
    return $size["size"];
  }
  public function findByPage(int $page): array
  {


    $index = $page === 1 ? 0 : $page * self::LIMIT;
    $stmt = $this->getPdo()->prepare("SELECT post_id,user_id,image,Extracto,created_at FROM posts LIMIT 10 OFFSET :limit");
    $stmt->bindParam(":limit", $index);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
    $arrayPost = [];
    foreach ($data as $postSTD) {
      $post = new Post();
      $post->setPostId($postSTD->post_id)
        ->setUserId($postSTD->user_id)
        ->setImage($postSTD->image ?? null)
        // ->setContent($postSTD->content)
        ->setExtracto($postSTD->Extracto)
        ->setCreatedAt($postSTD->created_at);
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
    $extracto = substr($content, 0, 120);
    $date = $data->getCreatedAt();
    $image = $data->getImage();
    $stmt = $this->getPdo()->prepare("INSERT INTO posts (user_id, image,content,Extracto, created_at) VALUES (:user_id, :image,:content,:extracto, :created_at)");
    $stmt->bindParam(":user_id", $userId);
    $stmt->bindParam(":image", $image);
    $stmt->bindParam(":content", $content);
    $stmt->bindParam(":extracto", $extracto);
    $createdAt = $date->format("Y-m-d H:i:s");
    $stmt->bindParam(":created_at", $createdAt);
    $results = ["status" => $stmt->execute(), "pk" => $this->getPdo()->lastInsertId()];
    return $results;
  }

  public function insertCategories(object $data)
  {
    $stmt = $this->getPdo()->prepare("INSERT INTO post_category ( id_post, id_category)
    VALUES ( :id_post, :id_category)");
    $postId = $data->getPostId();
    foreach ($data->getCategories() as $category) {
      if (!is_array($category)) {

        $idCategory = (int)$category->getId();
        $stmt->bindParam(":id_post", $postId);
        $stmt->bindParam(":id_category", $idCategory);
        $stmt->execute();
      }
    }

    // $results = ["status" => $stmt->execute(), "pk" => $this->getPdo()->lastInsertId()];
    return true;
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
