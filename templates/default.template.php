<h1>List of posts</h1>
<section class="grid">

  <?php foreach ($posts as $post) : ?>
    <div class="grid__post">
      <?php if ($post->getImage() !== null) : ?>
        <a href="/post/<?= $post->getPostId() ?>">
          <img class="article__img" src="<?= $post::IMAGE_PATH . $post->getImage() ?>" alt="<?= $post->getContent() ?>">
        </a>
      <?php endif; ?>
      <a href="/post/<?= $post->getPostId() ?>"><?= $post->getContent() ?></a>
      <small>Creado por <?= $post?->getUserId() ?></small>
    </div>
  <?php endforeach; ?>
</section>

<?php if ($pagePreview > 0) : ?>
  <a href="?page=<?= $pagePreview ?>">Post nuevos</a>
<?php endif; ?>
<?php if (count($posts) === 10) : ?>
  &nbsp;Página actual <?= $page ?>&nbsp;
  <a href="?page=<?= $pageNext ?>">Post antiguos</a>
<?php endif; ?>
