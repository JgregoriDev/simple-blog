<?php $date = new DateTimeImmutable($post->getCreatedAt()); ?>
<article class="row my-3">

  <small>Post creado por usuario <?= $post->getUserId() . ' - ' . $date->format('d/m/Y H:i:s')  ?></small>
  <h1 class="article__title">Post with id <?= $post->getPostId() ?></h1>
  <?php if ($post->getImage() !== null) :  ?>
    <img class="article__img" class="img" src="<?= $post::IMAGE_PATH . $post->getImage() ?>" alt="<?= $post->getContent() ?>">
  <?php endif; ?>
  <p class="article__content"><?= $post->getContent() ?></p>
</article>
<h2>Comments</h2>
<?php if ($username !== '') : ?>
  <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <input type="hidden" name="post_id" value="<?= $post->getPostId() ?>">
    <input type="hidden" name="user_id" value="<?= $username ?>">
    <section>
      <div class=" editor">
        <div class="mb-3">
          <label for="" class="form-label">City</label>
          <select class="form-select form-select-lg" name="" id="">
            <option selected value="">Normal</option>
            <option value="h1">Heading 1</option>
            <option value="h2">Heading 2</option>
            <option value="h3">Heading 2</option>
          </select>
        </div>
        <div class=" d-flex justify-content-center gap-2 align-content-center">

          <button class="editor__button editor__button--bolder">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor" viewBox="0 0 368 448">
              <path d="M 0 8 Q 1 1 8 0 L 40 0 L 72 0 L 224 0 Q 272 1 303 33 Q 335 64 336 112 Q 336 145 319 171 Q 303 197 276 211 Q 316 221 342 253 Q 367 285 368 328 Q 367 379 333 413 Q 299 447 248 448 L 72 448 L 40 448 L 8 448 Q 1 447 0 440 Q 1 433 8 432 L 32 432 L 32 216 L 32 16 L 8 16 Q 1 15 0 8 L 0 8 Z M 48 432 L 72 432 L 248 432 Q 292 431 322 402 Q 351 372 352 328 Q 351 284 322 254 Q 292 225 248 224 L 224 224 L 48 224 L 48 432 L 48 432 Z M 48 208 L 224 208 Q 265 207 292 180 Q 319 153 320 112 Q 319 71 292 44 Q 265 17 224 16 L 72 16 L 48 16 L 48 208 L 48 208 Z" />
            </svg>
          </button>
          <button class="editor__button editor__button--underline">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor" viewBox="0 0 448 448">
              <path d="M 0 8 Q 1 1 8 0 L 136 0 Q 143 1 144 8 Q 143 15 136 16 L 80 16 L 80 208 Q 82 269 122 310 Q 163 350 224 352 Q 285 350 326 310 Q 366 269 368 208 L 368 16 L 312 16 Q 305 15 304 8 Q 305 1 312 0 L 440 0 Q 447 1 448 8 Q 447 15 440 16 L 384 16 L 384 208 Q 382 276 337 321 Q 292 366 224 368 Q 156 366 111 321 Q 66 276 64 208 L 64 16 L 8 16 Q 1 15 0 8 L 0 8 Z M 0 440 Q 1 433 8 432 L 440 432 Q 447 433 448 440 Q 447 447 440 448 L 8 448 Q 1 447 0 440 L 0 440 Z" />
            </svg>
          </button>
          <button class="editor__button editor__button--italic">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor" viewBox="0 0 384 448">
              <path d="M 128 8 Q 129 1 136 0 L 376 0 Q 383 1 384 8 Q 383 15 376 16 L 285 16 L 116 432 L 248 432 Q 255 433 256 440 Q 255 447 248 448 L 8 448 Q 1 447 0 440 Q 1 433 8 432 L 99 432 L 268 16 L 136 16 Q 129 15 128 8 L 128 8 Z" />
            </svg>
          </button>
          <button class="editor__button editor__button--link"><svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor" viewBox="0 0 596 460">
              <path d="M 558 219 Q 596 179 596 128 L 596 128 Q 596 77 558 38 Q 519 0 468 0 Q 417 0 377 38 L 360 55 Q 356 60 360 66 Q 366 71 372 66 L 389 49 Q 423 16 468 16 Q 512 16 547 49 Q 580 83 580 128 Q 580 173 547 207 L 411 343 Q 377 376 332 376 Q 287 376 253 343 Q 220 309 220 264 Q 220 219 253 185 L 292 145 Q 297 139 292 134 Q 287 129 281 134 L 241 173 Q 204 213 204 264 Q 204 315 241 354 Q 281 392 332 392 Q 383 392 422 354 L 558 219 L 558 219 Z M 38 241 Q 0 281 0 332 L 0 332 Q 0 383 38 422 Q 77 460 128 460 Q 179 460 219 422 L 236 405 Q 240 400 236 394 Q 230 389 224 394 L 207 411 Q 173 444 128 444 Q 84 444 49 411 Q 16 377 16 332 Q 16 287 49 253 L 185 117 Q 219 84 264 84 Q 309 84 343 117 Q 376 151 376 196 Q 376 241 343 275 L 304 315 Q 299 321 304 326 Q 309 331 315 326 L 355 287 Q 392 247 392 196 Q 392 145 355 106 Q 315 68 264 68 Q 213 68 174 106 L 38 241 L 38 241 Z" />
            </svg></button>
          <button class="editor__button editor__button--ol">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor" viewBox="0 0 489 440">
              <path d="M 25 8 Q 26 1 33 0 L 65 0 Q 72 1 73 8 L 73 168 L 113 168 Q 120 169 121 176 Q 120 183 113 184 L 17 184 Q 10 183 9 176 Q 10 169 17 168 L 57 168 L 57 16 L 33 16 Q 26 15 25 8 L 25 8 Z M 96 279 Q 86 267 71 266 L 71 266 Q 57 265 44 275 L 22 294 Q 16 298 11 293 Q 7 287 12 282 L 34 263 Q 51 249 72 250 Q 93 252 108 268 Q 122 284 121 304 Q 121 324 107 339 L 28 424 L 121 424 Q 128 425 129 432 Q 128 439 121 440 L 9 440 Q 4 440 2 435 Q 0 430 3 427 L 95 328 Q 105 317 105 304 Q 106 290 96 279 L 96 279 Z M 193 48 L 481 48 Q 488 49 489 56 Q 488 63 481 64 L 193 64 Q 186 63 185 56 Q 186 49 193 48 L 193 48 Z M 193 208 L 481 208 Q 488 209 489 216 Q 488 223 481 224 L 193 224 Q 186 223 185 216 Q 186 209 193 208 L 193 208 Z M 193 368 L 481 368 Q 488 369 489 376 Q 488 383 481 384 L 193 384 Q 186 383 185 376 Q 186 369 193 368 L 193 368 Z" />
            </svg>
          </button>
          <button class="editor__button editor__button--ul">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor" viewBox="0 0 456 352">
              <path d="M 16 0 Q 1 1 0 16 Q 1 31 16 32 Q 31 31 32 16 Q 31 1 16 0 L 16 0 Z M 16 160 Q 1 161 0 176 Q 1 191 16 192 Q 31 191 32 176 Q 31 161 16 160 L 16 160 Z M 32 336 Q 31 321 16 320 Q 1 321 0 336 Q 1 351 16 352 Q 31 351 32 336 L 32 336 Z M 128 8 Q 121 9 120 16 Q 121 23 128 24 L 448 24 Q 455 23 456 16 Q 455 9 448 8 L 128 8 L 128 8 Z M 128 168 Q 121 169 120 176 Q 121 183 128 184 L 448 184 Q 455 183 456 176 Q 455 169 448 168 L 128 168 L 128 168 Z M 128 328 Q 121 329 120 336 Q 121 343 128 344 L 448 344 Q 455 343 456 336 Q 455 329 448 328 L 128 328 L 128 328 Z" />
            </svg>
          </button>
          <button class="editor__button editor__button--noformat">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor" viewBox="0 0 644 516">
              <path d="M 15 4 Q 9 0 4 5 Q 0 11 5 16 L 629 512 Q 635 516 640 511 Q 644 505 639 500 L 15 4 L 15 4 Z M 392 50 L 550 50 Q 558 51 557 60 L 546 104 Q 545 111 552 114 Q 559 115 562 108 L 573 64 Q 575 52 568 43 Q 562 34 550 34 L 386 34 L 386 34 L 183 34 Q 167 35 160 49 L 174 59 L 175 56 Q 177 50 183 50 L 375 50 L 335 187 L 348 197 L 392 50 L 392 50 Z M 296 319 L 252 466 L 170 466 Q 163 467 162 474 Q 163 481 170 482 L 258 482 L 258 482 L 346 482 Q 353 481 354 474 Q 353 467 346 466 L 269 466 L 309 329 L 296 319 L 296 319 Z" />
            </svg>
          </button>
        </div>
      </div>
      <div class="form-floating w-75">
        <div class="form-floating w-75">
          <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="content"></textarea>
          <label for="my-2 floatingTextarea">Comments</label>
        </div>
    </section>

    <button class="my-2 btn btn-primary">Comentar</button>
  </form>
<?php else : ?>
  <h3>Debes <a href="/login">iniciar sesión</a> para poder comentar</h3>
<?php endif; ?>

<?php if ($post->getComments() !== null && count($post->getComments()) > 0) : ?>
  <?php foreach ($post->getComments() as $comment) : ?>
    <div class="my-2">

      <a class="my-1" href="/user/<?= $comment->getUserId() ?>/comments"> <?= $comment->getUserId(), " ", $comment->getCreatedAt() ?></a>
      <?php if ($username !== "") : ?>
        <a href="/comment/<?= $comment->getCommentId() ?><?= $comment->getPostId() ?>">Eliminar</a>
      <?php endif; ?>
      <p> <?= $comment->getContent() ?></p>
    </div>
  <?php endforeach; ?>

<?php else : ?>

  <p>No hay comentarios</p>
<?php endif; ?>
