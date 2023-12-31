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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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
      <nav class="">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Bienvenido <?= $username ?>
        </button>

        <ul class="dropdown-menu">

          <li class="dropdown-item"><a href="/logout">Logout</a></li>
          <li class="dropdown-item"><a href="/new/post">Crear post</a></li>
        </ul>
      </nav>
      </div>
    <?php endif; ?>
  </header>
  <main class="container">

    <?= $content ?>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

</body>

</html>
