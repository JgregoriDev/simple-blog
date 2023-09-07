<h1>List of posts</h1>
<section class="row">

  <div class="col col-lg-8 row">


    <?php foreach ($posts as $post) : ?>
      <article class=" col col-md-6 col-lg-4">
        <?php if ($post->getImage() !== null) : ?>
          <a href="/post/<?= $post->getPostId() ?>">
            <img class="article__img" src="<?= $post::IMAGE_PATH . $post->getImage() ?>" alt="<?= $post->getContent() ?>">
          </a>
        <?php endif; ?>
        <a href="/post/<?= $post->getPostId() ?>"><?= $post->getContent() ?></a>
        <small>Creado por <?= $post?->getUserId() ?></small>
      </article>
    <?php endforeach; ?>
    <nav aria-label="Page navigation example">
      <ul class="d-flex justify-content-center pagination">
        <?php if ($page > 1) : ?>
          <li class="page-item"><a class="page-link" href="?page=<?= 1 ?>">First</a></li>
        <?php endif; ?>
        <li class="page-item"><a class="page-link" href="?page=<?= $pagePreview ?>">Previous</a></li>
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
