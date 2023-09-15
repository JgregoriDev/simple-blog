<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use App\Config\Core\Registry;

require_once __DIR__ . "/../../bootstrap.php";
$routes = new RouteCollection();
$routes->add(
  'default',
  new Route(
    path: '/',
    defaults: ['_controller' => 'App\Controller\DefaultController::mainPage'],
    methods: ["GET", "POST"],
  )
);
$routes->add(
  'login',
  new Route(
    path: '/login',
    defaults: ['_controller' => 'App\Controller\LoginController::login'],
    methods: ["GET", "POST"],
  )
);
$routes->add(
  'search_Post',
  new Route(
    path: '/post/search',
    defaults: ['_controller' => 'App\Controller\DefaultController::postSearch'],
    methods: ["GET"],
  )
);

$routes->add(
  'getPostByID',
  new Route(
    path: '/post/{id}',
    defaults: ['_controller' => 'App\Controller\DefaultController::getPost'],
    methods: ["GET", "POST"],
  )
);
$routes->add(
  'post_delete',
  new Route(
    path: '/post/{id}/borrar',
    defaults: ['_controller' => 'App\Controller\DefaultController::deletePost'],
    methods: ["GET", "POST"],
  )
);
$routes->add(
  'addPost',
  new Route(
    path: '/new/post',
    defaults: ['_controller' => 'App\Controller\DefaultController::addPost'],
    methods: ["GET", "POST"],
  )
);
$routes->add(
  'logout',
  new Route(
    path: '/logout',
    defaults: ['_controller' => 'App\Controller\LoginController::logout'],
    methods: ["GET", "POST"],
  )
);
$routes->add(
  'registrarUsuario',
  new Route(
    path: '/registrar',
    defaults: ['_controller' => 'App\Controller\LoginController::registerUser'],
    methods: ["GET", "POST"],
  )
);
$routes->add(
  'categoryListPost',
  new Route(
    path: '/category/{slug}',
    defaults: ['_controller' => 'App\Controller\CategoryController::listPostByCategory'],
    methods: ["GET", "POST"],
  )
);



return $routes;
