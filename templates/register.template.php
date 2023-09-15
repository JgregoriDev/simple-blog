<?php

use Gregwar\Captcha\CaptchaBuilder; ?>
<div class="container">
  <form class="form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <input type="hidden" name="phrase" value="<?= $phraseNew ?>">
    <div class="form__container"><label for="email">E-mail</label><input type="email" name="email" id="email" class=""></div>
    <div class="form__container"><label for="passwordA">Password:</label><input type="password" name="passwordA" id="passwordA" class=""></div>
    <div class="form__container"><label for="passwordB">Repeat the password:</label><input type="password" name="passwordB" id="passwordB" class=""></div>
    <div class="">
      <img loading="lazy" src="<?= $builder->inline() ?>" />
      <input class="" type="text" name="captcha" value="<?= $phraseNew ?>">
    </div>
    <div>
    </div>
    <div class="form__container"><input class="button" type="submit" value="Enviar"></div>
    <p>
      <?= $userMsg ?>
    </p>
  </form>
</div>
