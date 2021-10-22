<?php if(isset($post) == null): ?>
  <h2>Aucun Article</h2>
<?php else: ?>
  <h2><?= $post->getTitle() ?></h2>
  <h3><?= $post->getSubtitle() ?></h3>
  <p><?= $post->getContent() ?></p>
  <a href=<?= "/blog/post-{$post->id()}/edit" ?> data-id="<?= $post->id() ?>" >Modifier le post</a>
<?php endif; ?>