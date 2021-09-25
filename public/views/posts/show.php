<?php $title = 'Article n°' . $post->id(); ?>
<?php if(isset($post) == null): ?>
  <h2>Aucun Article</h2>
<?php else: ?>
  <h2><?= $post->getTitle() ?></h2>
  <h3><?= $post->getSubtitle() ?></h3>
  <p><?= $post->getContent() ?></p>
<?php endif; ?>