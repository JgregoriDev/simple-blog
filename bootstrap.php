<?php

use App\Config\Core\Registry;
use App\Config\Core\Session;

// $log = new Logger('blog_logger');
// $log->pushHandler(new StreamHandler(__DIR__ . "/./app.log", Logger::DEBUG));
// $log->pushHandler(new FirePHPHandler());
// Registry::set(Registry::LOGGER, $log);
$session = new Session();


Registry::set(Registry::SESSION, $session);
