<h1>List of posts</h1>
<section class="row">

  <div class="col col-lg-8 row">

    <?php if (count($posts) === 0) : ?>
      <h3 class="text-danger">No hay posts con este número de paginación</h3>
    <?php else : ?>
      <?php foreach ($posts as $post) : ?>
        <article class=" col col-md-6 col-lg-4 min-height-275 my-3">
          <?php if ($post->getImage() !== null) : ?>
            <a href="/post/<?= $post->getPostId() ?>">

              <img loading="lazy" class="article__img" src="<?= file_exists($post::IMAGE_PATH . $post->getImage()) ?
                                                              $post::IMAGE_PATH . $post->getImage() :
                                                              $post::IMAGE_PATH . "tux.png"
                                                            ?>" alt="<?= $post->getExtracto() ?>">
            </a>
          <?php else : ?>
            <a href="/post/<?= $post->getPostId() ?>">
              <img loading="lazy" class="article__img" src="<?= $post::IMAGE_PATH . "tux.png" ?>" alt="<?= $post->getExtracto() ?>">
            </a>
          <?php endif; ?>
          <a href="/post/<?= $post->getPostId() ?>"><?= $post->getExtracto() ?></a>
          <small>Creado por <?= $post?->getUserId() ?></small>
        </article>
      <?php endforeach; ?>
    <?php endif; ?>
    <nav aria-label="Page navigation example">
      <ul class="d-flex justify-content-center pagination">
        <?php if ($page > 1) : ?>
          <li class="page-item"><a class="page-link" href="?page=<?= 1 ?>">First</a></li>
          <li class="page-item"><a class="page-link" href="?page=<?= $pagePreview ?>">Previous</a></li>
        <?php endif; ?>
        <?php
        for ($pageNumber = 1; $pageNumber <= $countMaxSizePage; $pageNumber++) : ?>
          <a class="page-link" href="?page=<?= $pageNumber ?>"><?= $pageNumber ?></a>
        <?php endfor; ?>

        <?php if (count($posts) === 10) : ?>
          <li class="page-item"><a class="page-link" href="?page=<?= $pageNext ?>">Next</a></li>
          <li class="page-item"><a class="page-link" href="?page=<?= (int)$countMaxSizePage ?>">Last</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
  <div class="col col-lg-2 d-flex flex-column justify-content-start align-content-center gap-3">
    <h2>Categories</h2>
    <?php foreach ($categories as $category) : ?>
      <a href="/category/<?= $category->getNameCategory() ?>"><?= $category->getNameCategory() ?></a>
    <?php endforeach; ?>
  </div>
</section>
