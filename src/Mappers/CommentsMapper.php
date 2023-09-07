<?php

use App\Config\Core\Connection;
use App\Config\Interfaces\MapperInterface;

class CommentsMapper extends Connection
{

  public function __construct()
  {
    parent::__construct();
  }
  public function getCommentsByPostId(int $id)
  {
  }
}
