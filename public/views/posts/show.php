<?php if(isset($post) == null): ?>
  <h2>Aucun Article</h2>
<?php else: ?>
  <h2><?= $post->getTitle() ?></h2>
  <h4><?= $post->getSubtitle() ?></h4>
  <img src="<?= $post->getPhoto() ?>" alt="Photo de l'article">
  <p><?= $post->getContent() ?></p>
  <p><?= $postAuthor->getFullname() ?></p>
  <p><?= $postCreatedAt ?></p>
  <a href=<?= "/blog/post-{$post->id()}/edit" ?> data-id="<?= $post->id() ?>" >Modifier le post</a>
  <a href=<?= "/blog/post-{$post->id()}/comment/new" ?> >Ajouter un commentaire</a>
<?php endif; ?>

<h1>Partie commentaire</h1>

<?php if($commentsAttributes == []): ?>
  <h3>Aucun commentaire</h3>
  <?php else: ?>
    <?php foreach($commentsAttributes as $array): ?>
      <h2><?= $array['comment']->getTitle() ?></h2>
      <p><?= $array['comment']->getContent() ?></p>
      <p><?= $array['commentAuthorFullname'] ?></p>
      <p><?= $array['commentCreatedAt'] ?></p>
      <a href=<?= "/blog/post-{$post->id()}/comment-{$array['comment']->id()}/edit" ?> >Modifier le commentaire</a>
    <?php endforeach; ?>
<?php endif; ?>