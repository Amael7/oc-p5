<h1>Admin Dashboard</h1>

<a href=<?= "/blog/post/new" ?>><h3 class="btn mg-top-md">Créer un nouvel article</h3></a>
<div class="post-section">
  <?php if(isset($posts) && $posts == []): ?>
    <h2>Aucun Articles</h2>
    <?php else: ?>
      <?php foreach($posts as $post): ?>
        <div class="article">
          <h2>
            <a href=<?= "/blog/post-" . $post->getId() ?> data-id="<?= $post->getId() ?>" class="pd-left-none">
              <?= $post->getTitle() ?>
            </a>
          </h2>
          <p><span class="color-yellow pd-none"><?= is_countable($post->getAllUnvalidComments('FALSE'))?  count($post->getAllUnvalidComments('FALSE')) : 1 ?></span> Commentaire(s) en attente de validation.</p>
          <h3><?= $post->getSubtitle() ?></h3>
          <p><?= $post->getContent() ?></p>
          <p>dernière modification : <?= $post->displayDateTime($post->getUpdatedAt(), false) ?></p>
          <?php if (isset($admin) && $admin): ?>
            <a href=<?= "/blog/post-{$post->getId()}/edit" ?> data-id="<?= $post->getId() ?>" class="mg-left-xs btn btn--pd-xs mg-top-xs">Modifier le post</a>
            <a href=<?= "/blog/post-{$post->getId()}/delete" ?> data-id="<?= $post->getId() ?>" class="mg-left-xs btn btn--pd-xs btn-bg-red">Supprimer le post</a>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
  <?php endif; ?>
</div>