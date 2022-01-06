<?php if(isset($posts) && $posts == []): ?>
  <h2>Aucun Articles</h2>
  <?php else: ?>
    <?php foreach($posts as $post): ?>
      <h2>
        <a href=<?= "/blog/post-" . $post->getId() ?> data-id="<?= $post->getId() ?>">
          <?= $post->getTitle() ?>
        </a>
      </h2>
      <h3><?= $post->getSubtitle() ?></h3>
      <p><?= $post->getContent() ?></p>
    <?php endforeach; ?>
<?php endif; ?>