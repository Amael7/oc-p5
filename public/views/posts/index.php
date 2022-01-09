<div class="post-section">
  <?php if(isset($posts) && $posts == []): ?>
    <h1>Aucun Articles</h1>
    <?php else: ?>
      <h1 class="mg-left-xs">Articles</h1>
      <?php foreach($posts as $post): ?>
        <div class="article">
          <h2>
            <a href=<?= "/blog/post-" . $post->getId() ?> data-id="<?= $post->getId() ?>" class="pd-left-none">
              <?= $post->getTitle() ?>
            </a>
          </h2>
          <h3><?= $post->getSubtitle() ?></h3>
          <p><?= $post->getContent() ?></p>
          <p>dernière modification : <?= $post->displayDateTime($post->getUpdatedAt(), false) ?></p>
        </div>
        <?php endforeach; ?>
  <?php endif; ?>
</div>