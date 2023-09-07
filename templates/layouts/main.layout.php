<?php

use App\Config\Core\Registry;

$session = Registry::get(Registry::SESSION);
$username = $session->get("username");
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://<?= htmlspecialchars($_SERVER['HTTP_HOST']) ?>/assets/css/style.css">

  <title>Blog de ejemplo</title>
</head>

<body>
  <header class="header">

    <h1 class="header__title"><a class="title" href="/">Blog de ejemplo</a></h1>
    <?php if ($username === '') : ?>
      <div class="header__action">
        <a href="/login">Login</a>
        <a href="/registrar">Registrar</a>
      </div>
    <?php else : ?>
      <div class="header__user">Bienvenido <?= $username ?>
        <nav class="nav">
          <ul class="nav__list">

            <li class="nav__item"><a href="/logout">Logout</a></li>
            <li class="nav__item"><a href="/new/post">Crear post</a></li>
          </ul>
        </nav>
      </div>
    <?php endif; ?>
  </header>
  <main class="d-flex">

    <?= $content ?>
  </main>


</body>

</html>
