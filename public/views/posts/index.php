<?php if(isset($posts) == []): ?>
  <h2>Aucun Articles</h2>
  <?php else: ?>
    <a href="/blog/post/new">Créer un nouvelle article</a>
    <?php foreach($posts as $post): ?>
      <a href=<?= "/blog/post-" . $post->id() ?> data-id="<?= $post->id() ?>" >
        <h2><?= $post->getTitle() ?></h2>
      </a>
      <h3><?= $post->getSubtitle() ?></h3>
      <p><?= $post->getContent() ?></p>
      <a href=<?= "/blog/post-{$post->id()}/delete" ?> data-id="<?= $post->id() ?>" >Supprimer le post</a>
    <?php endforeach; ?>
<?php endif; ?>