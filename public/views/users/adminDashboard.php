<h1>Admin Dashboard</h1>

<?php if(isset($posts) && $posts == []): ?>
  <h2>Aucun Articles</h2>
  <?php else: ?>
    <a href="/blog/post/new">Créer un nouvelle article</a>
    <?php foreach($posts as $post): ?>
      <a href=<?= "/blog/post-" . $post->getId() ?> data-id="<?= $post->getId() ?>" >
        <h2><?= $post->getTitle() ?></h2>
      </a>
      <p><span style='color: yellow;'><?= is_countable($post->getAllUnvalidComments('FALSE'))?  count($post->getAllUnvalidComments('FALSE')) : 1 ?></span> Commentaire(s) en attente de validation.</p>
      <h3><?= $post->getSubtitle() ?></h3>
      <p><?= $post->getContent() ?></p>
      <a href=<?= "/blog/post-{$post->getId()}/delete" ?> data-id="<?= $post->getId() ?>" >Supprimer le post</a>
    <?php endforeach; ?>
<?php endif; ?>