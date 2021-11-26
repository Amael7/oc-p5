<?php if(isset($posts) && $posts == []): ?>
  <h2>Aucun Articles</h2>
  <?php else: ?>
    <?php foreach($posts as $post): ?>
      <a href=<?= "/blog/post-" . $post->getId() ?> data-id="<?= $post->getId() ?>" >
        <h2><?= $post->getTitle() ?></h2>
      </a>
      <h3><?= $post->getSubtitle() ?></h3>
      <p><?= $post->getContent() ?></p>
    <?php endforeach; ?>
<?php endif; ?>