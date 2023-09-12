<?php

namespace App\Controller;

use App\Config\Core\Content;
use App\Config\Core\Registry;
use App\Config\Utilities\FileUploadManagement;
use App\Entities\Post;
use App\Mappers\CategoriesMapper;
use App\Mappers\PostMapper;
use App\Mappers\UserMapper;
use App\Repositories\CategoriesRepository;
use App\Repositories\PostRepository;
use App\Repositories\UserRepository;
use stdClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
  private $postRepository;
  public function __construct()
  {
    $postMapper = new PostMapper();
    $this->postRepository = new PostRepository($postMapper);
  }
  public function index(Request $request)
  {
    $categoryRepository = new CategoriesRepository(new CategoriesMapper());
    $categories = $categoryRepository->getAllCategories();
    $session = Registry::get(Registry::SESSION);
    $page = strval($request->query->get('page') ?? 1);
    $pageNext = $page + 1;
    $pagePreview = $page - 1;
    $pagePreview = $pagePreview < 1 ? 1 : $pagePreview;
    $page = $page < 1 ? 1 : $page;
    $lifeTime = $session->get("lifeTime");
    if (time() > $lifeTime) {
      $session->destroy("username");
    }
    $hi = "Hello world";

    $username = $_SESSION["username"] ?? "";
    $count = $this->postRepository->countArray();
    $countMaxSizePage = ($count / 10);
    $posts = $this->postRepository->findByPage($page);
    $content = Content::setContent('default', 'main', compact('categories', 'username', 'posts', 'countMaxSizePage', 'page', 'pageNext', 'pagePreview'));
    return new Response($content);
  }
  public function getPost(Request $request, int $id)
  {
    $session = Registry::get(Registry::SESSION);
    $username = $session->get("username") ?? "";
    $post = $this->postRepository->find($id);
    $post = $this->postRepository->findPostsGenres($post);
    if ($username !== "") {
      if ($request->isMethod("post")) {
        $userRepository = new UserRepository(new UserMapper());
        $userId = $userRepository->getUserID($username);
        $stdObject = new stdClass();
        $post_id = $request->request->get("post_id");
        $content = $request->request->get("content");
        $content = $request->request->get("category");
        if (!empty($post_id) && !empty($content)) {
          $post_id = htmlspecialchars($post_id);
          $comment = htmlspecialchars($content);
          $stdObject->user_id = $userId;
          $stdObject->post_id = $post_id;
          $stdObject->comment = $comment;

          $userRepository->insertComment($stdObject);
          $urlPath = "http://localhost:8000" . $_SERVER["PATH_INFO"];
          header("Location: $urlPath");
          exit;
        }
      }
    }

    $content = Content::setContent('find', 'main', compact('username', 'post'));
    return new Response($content);
  }

  public function deletePost(Request $request, int $id)
  {
    session_start();
    $username = $_SESSION["username"] ?? "";
    $std = new stdClass();
    $std->id = $id;
    $this->postRepository->delete($std);
    if (isset($_SERVER['HTTP_REFERER'])) {
      header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
      header("Location: index.php");
    }
    $content = Content::setContent('find', 'main', compact('username', 'post'));

    return new Response($content);
  }

  public function addPost(Request $request)
  {
    $categoryRepository = new CategoriesRepository(new CategoriesMapper());
    $categories = $categoryRepository->getAllCategories();
    $postMessageStatus = [
      "status" => "",
      "post" => ""
    ];
    $session = Registry::get(Registry::SESSION);
    $username = $session->get("username");
    $target_dir = "./assets/images/";
    $uploadOk = 1;
    if ($username === "") {
      header("Location: login.php");
      return;
    }

    if ($username === '') {
      header("Location: login.php");
      return;
    }
    $post = new Post();
    $postMessageStatus = ["status" => "", "post" => ""];
    if ($request->isMethod('post')) {

      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

      $fileUploadManagement = new FileUploadManagement();
      $postMessageStatus = $fileUploadManagement->checkFileStatus($target_file, $imageFileType);
      if ($fileUploadManagement->getUploadOk() === -1) {
        if ($fileUploadManagement->getStatusOfFileWasUploadSuccessfully($target_file)) {
          // $postMessageStatus["status"] = "message-success";
          // $postMessageStatus["post"] = "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";

          $post->setImage($_FILES["fileToUpload"]["name"])

            ->setContent($request->request->get('contenido'))
            ->setUserId(2)
            ->setCreatedAt(new \DateTime());
          $postStatus = $this->postRepository->insert($post);

          $post->setPostId((int)$postStatus['pk']);
          $selectedCategories = $_POST['categories'];
          $arrayCategories = [];


          foreach ($categories as $category) {
            if (in_array($category->getId(), $selectedCategories)) {
              $arrayCategories[] = $category;
            }
          }

          $post->setCategories($arrayCategories);
          $this->postRepository->insertCategories($post);
          $postMessageStatus["status"] = $postStatus["status"] ? "message-success" : "message-error";
          $postMessageStatus["post"] = $postStatus["status"] ? "Post creado de manera satisfactoria <a href=\"/post/{$postStatus['pk']}\">pulsa aquí para ver el resultado</a>" : "Error al crear el post";
        } else {
          $errorStatus = true;
          $postMessageStatus["post"] = "Sorry, there was an error uploading your file.";
        }
      }
    }
    $content = Content::setContent('post-form', 'main', compact('username', 'categories', 'post', 'postMessageStatus'));

    return new Response($content);
  }
}
