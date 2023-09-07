<h2>Category <?= $category->getNameCategory() ?></h2>
<div class="row">
  <?php foreach ($category->getListOfPosts() as $post) : ?>

    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <a href="/post/<?= $post->getPostId() ?>">
            <h5 class="card-title"><?= $post->getContent() ?></h5>
            <p class="card-text"><?= $post->getImage() ?></p>
          </a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
