<?php $title = 'Les Articles'; ?>
<?php if(isset($posts) == []): ?>
  <h2>Aucun Articles</h2>
  <?php else: ?>
    <?php foreach($posts as $post): ?>
      <a href=<?= "/blog/post-" . $post->id() ?> data-id="<?= $post->id() ?>" >
        <h2><?= $post->getTitle() ?></h2>
      </a>
      <h3><?= $post->getSubtitle() ?></h3>
      <p><?= $post->getContent() ?></p>
    <?php endforeach; ?>
<?php endif; ?>