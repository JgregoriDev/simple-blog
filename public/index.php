<?php


// error_reporting(E_ALL);

// ini_set("display_errors", 1);

// error_reporting(E_ALL);
// phpinfo();

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

require "../vendor/autoload.php";
$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../src/Config/Routes.php';

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

try {
  $request->attributes->add($matcher->match($request->getPathInfo()));

  $controller = $controllerResolver->getController($request);
  $arguments = $argumentResolver->getArguments($request, $controller);

  $response = call_user_func_array($controller, $arguments);
} catch (ResourceNotFoundException $exception) {
  $response = new Response('Not Found', 404);
} catch (Exception $exception) {
  $response = new Response('An error occurred: ' . $exception->getMessage(), 500);
}

$response->send();
