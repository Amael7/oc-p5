<?php if(isset($post) == null): ?>
  <h2>Aucun Article</h2>
<?php else: ?>
  <h2><?= $post->getTitle() ?></h2>
  <h4><?= $post->getSubtitle() ?></h4>
  <img src="<?= $post->getPhoto() ?>" alt="Photo de l'article">
  <p><?= $post->getContent() ?></p>
  <p><?= $post->getAuthorName() ?></p>
  <p><?= $post->displayDateTime($post->getCreatedAt()) ?></p>
  <?php if (isset($_SESSION['user_auth'])): ?>
    <a href=<?= "/blog/post-{$post->getId()}/comment/new" ?> >Ajouter un commentaire</a>
  <?php endif; ?>
  <?php if (isset($_SESSION['user_admin']) && $_SESSION['user_admin'] === true): ?>
    <a href=<?= "/blog/post-{$post->getId()}/edit" ?> data-id="<?= $post->getId() ?>" >Modifier le post</a>
  <?php endif; ?>
<?php endif; ?>


<?php if (isset($_SESSION['user_admin']) && $_SESSION['user_admin'] === true): ?>
  <h2>Commentaire en attente de validation :</h2>
  <?php if (isset($unvalidComments) == false): ?>
    <h3>Aucun commentaire.</h3>
    <?php else: ?>
      <?php foreach($unvalidComments as $array): ?>
        <h2><?= $array['comment']->getTitle() ?></h2>
        <p><?= $array['comment']->getContent() ?></p>
        <p><?= $array['commentAuthorFullname'] ?></p>
        <p><?= $array['commentCreatedAt'] ?></p>
        <a href=<?= "/blog/admin/post-{$post->getId()}/comment-{$array['comment']->getId()}/valid" ?>><?= ($array['comment']->getValid())? "Annuler le commentaire" : "Valider le commentaire" ?></a>
        <a href=<?= "/blog/post-{$post->getId()}/comment-{$array['comment']->getId()}/delete" ?> >Supprimer le commentaire</a>
      <?php endforeach; ?>
  <?php endif; ?>

<?php endif; ?>

<h1>Partie commentaire</h1>
<?php if (isset($validComments) == false): ?>
  <h3>Aucun commentaire.</h3>
  <?php else: ?>
    <?php foreach($validComments as $array): ?>
      <h2><?= $array['comment']->getTitle() ?></h2>
      <p><?= $array['comment']->getContent() ?></p>
      <p><?= $array['commentAuthorFullname'] ?></p>
      <p><?= $array['commentCreatedAt'] ?></p>
      
      <?php if (isset($_SESSION['user_admin']) && $_SESSION['user_admin'] === true): ?>
        <a href=<?= "/blog/admin/post-{$post->getId()}/comment-{$array['comment']->getId()}/valid" ?>><?= ($array['comment']->getValid())? "Annuler le commentaire" : "Valider le commentaire" ?></a>
      <?php endif; ?>

      <?php if ((isset($_SESSION['user_auth']) && ("{$_SESSION['user_auth']}" === $array['comment']->getAuthorId()) || (isset($_SESSION['user_admin']) && $_SESSION['user_admin'] === true))): ?>
        <a href=<?= "/blog/post-{$post->getId()}/comment-{$array['comment']->getId()}/delete" ?> >Supprimer le commentaire</a>
      <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>