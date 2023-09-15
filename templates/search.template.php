<section>
  <div class="my-3">

    <h3>Buscar post con título <?= $postStringSearch ?></h3>
    <p>Resultados de la busqueda encontrados <?= count($arrayPostsBusqueda) ?></p>
  </div>
  <?php if ($postStringSearch === false || count($arrayPostsBusqueda) === 0) : ?>
    <div class="my-3">
      <p class="text-danger">No hay post con este título</p>
    </div>
  <?php else : ?>
    <?php foreach ($arrayPostsBusqueda as $post) : ?>
      <h6>
        <a href="/post/<?= $post->getPostId() ?>">
          <?= $post->getExtracto() ?>
        </a>
        <p class="my-2">Creado el día <?= $post->getCreatedAt()->format('d/m/Y') ?></p>
      </h6>
    <?php endforeach; ?>
  <?php endif; ?>
</section>
