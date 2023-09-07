<?php

namespace App\Repositories;

class CommentsRepository
{
  private $commentMapper;
  public function __construct(CommentMapper $commentMapper)
  {
    $this->commentMapper = $commentMapper;
  }
  public function getCommentsByMovieId(int $id)
  {
    return $id;
  }
}
