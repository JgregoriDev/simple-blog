<?php

namespace App\Controller;

use DateTime;
use DateInterval;
use DateTimeImmutable;
use App\Mappers\UserMapper;
use App\Config\Core\Content;
use App\Config\Core\Registry;
use App\Config\Utilities\SendMail;
use SimpleCaptcha\Builder;
use App\Repositories\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController
{
  private $userRepository;
  public function __construct()
  {
    $userMapper = new UserMapper();
    $this->userRepository = new UserRepository($userMapper);
  }
  public function login(Request $request)
  {
    $session = Registry::get(Registry::SESSION);

    $isConnected = $session?->get("username") !== null &&
      $session->get("username") !== "";
    if ($isConnected) {
      header("Location: /");
      return;
    }
    if ($request->isMethod("POST")) {
      $password = $request->request->get("password") ?? "";
      $userName = $request->request->get("username") ?? "";
      $isCorrectTheRequest = isset($password) ||
        isset($userName) ||
        $password === "" ||
        $userName === "";
      if (!$isCorrectTheRequest) {
        $errors = "The username or password is incorrect.";
      }

      $user = $this->userRepository->login($userName);
      if (password_verify($password, $user->getPasswordHash()) === true) {

        $_SESSION["random_uuid"] = bin2hex(random_bytes(32));
        $session->set("username", $user->getUsername());
        $session->set("role", $user->getRole());
        $session->set("lifeTime", time() + 604800);
        header("Location: /");
        return;
      }
    }
    $hi = "Hello world";
    $content = Content::setContent('login', 'main', compact('hi'));
    return new Response($content);
  }
  public function logout(Request $request)
  {
    $session = Registry::get(Registry::SESSION);
    $session->destroy("username");
    header("Location: http://localhost:8000/");
    return;
  }

  public function registerUser(Request $request)
  {
    $isValid = false;
    $email = $passwordA = null;
    $session = Registry::get(Registry::SESSION);

    $builder = new Builder();
    $builder->build(200, 100);

    $phraseNew = $builder->phrase;

    if ($request->isMethod("POST")) {
      $captcha = $request->request->get("captcha");
      $phraseOld = $request->request->get("phrase");
      $email = $request->request->get("email");
      $passwordA = $request->request->get("passwordA");
      $passwordB = $request->request->get("passwordB");
      $passwordLenght = strlen($passwordA) >= 6;
      $passwordEquals = $passwordA === $passwordB;
      if ($phraseOld === $captcha) {

        if ($passwordLenght && $passwordEquals) {
          $isValid = true;
        }
      }
    }
    $userMsg = "";
    if ($isValid) {
      $session->set("phrase", $phraseNew);
      $passwordHash = password_hash($passwordA, PASSWORD_DEFAULT);
      $userStatus = $this->userRepository->registerUser($email, $passwordHash);
      if ($userStatus) {
        $mailer = new SendMail();
        $mailer->send($email);
      }
      $userMsg = $userStatus ? "Usuario insertado correctamente valida el usuario entrando al correo electrónico" : "Usuario no insertado";
    }

    $content = Content::setContent('register', 'main', compact('builder', 'phraseNew', 'userMsg', 'isValid'));


    return new Response($content);
  }
}
