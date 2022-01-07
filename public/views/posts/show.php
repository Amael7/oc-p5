<?php if(isset($post) == null): ?>
  <h2>Aucun Article</h2>
<?php else: ?>
  <div class="article">
    <h2><?= $post->getTitle() ?></h2>
    <img src="<?= $post->getPhoto() ?>" alt="Photo de l'article" class="article-photo">
    <h3><?= $post->getSubtitle() ?></h3>
    <p><?= $post->getContent() ?></p>
    <div class="article-infos">
      <h3 class="ft-wgt-bold"><?= $post->getAuthorName() ?></h3>
      <p><?= $post->displayDateTime($post->getCreatedAt()) ?></p>
    </div> 
  </div>
  
<?php endif; ?>
<div class="Commentaire-section">

  <h1>Commentaire</h1>

  <?php if (isset($_SESSION['tokenAuth'])): ?>
    <a href=<?= "/blog/post-{$post->getId()}/comment/new" ?> class="btn mg-left-xs mg-top-md">Ajouter un commentaire</a>
  <?php endif; ?>

  <?php if ((isset($admin) && $admin) && isset($unvalidComments) != false): ?>
    <div class="commentaire-validation">
      <h2>Commentaire en attente de validation :</h2>
      <?php if (isset($unvalidComments) == false): ?>
        <h3>Aucun commentaire.</h3>
        <?php else: ?>
          <?php foreach($unvalidComments as $array): ?>
            <div class="comment mg-bottom-md">
              <div class="info">
                <h3 class="ft-wgt-bold pd-btm-none"><?= $array['commentAuthorFullname'] ?></h3>
                <p class="color-grey pd-top-xxs"><?= $array['commentCreatedAt'] ?></p>
              </div>
              <div class="content">
                <h3 class="pd-top-xxs"><?= $array['comment']->getTitle() ?></h3>
                <p class="pd-btm-xxs pd-top-xxs mg-bottom-md"><?= $array['comment']->getContent() ?></p>
              </div>
              <a href=<?= "/blog/admin/post-{$post->getId()}/comment-{$array['comment']->getId()}/valid" ?> class="btn btn--pd-xs"><?= ($array['comment']->getValid())? "Annuler le commentaire" : "Valider le commentaire" ?></a>
              <a href=<?= "/blog/post-{$post->getId()}/comment-{$array['comment']->getId()}/delete" ?> class="btn btn--pd-xs btn-bg-red">Supprimer le commentaire</a>
            </div>
          <?php endforeach; ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php if (isset($validComments) == false): ?>
    <h3>Aucun commentaire.</h3>
    <?php else: ?>
      <?php foreach($validComments as $array): ?>
        <div class="comment mg-bottom-md">
          <div class="info">
            <h3 class="ft-wgt-bold pd-btm-none"><?= $array['commentAuthorFullname'] ?></h3>
            <p class="color-grey pd-top-xxs"><?= $array['commentCreatedAt'] ?></p>
          </div>
          <div class="content">
            <h3 class="pd-top-xxs"><?= $array['comment']->getTitle() ?></h3>
            <p class="pd-btm-xxs pd-top-xxs mg-bottom-md"><?= $array['comment']->getContent() ?></p>
          </div>
          <?php if (isset($admin) && $admin): ?>
            <a href=<?= "/blog/admin/post-{$post->getId()}/comment-{$array['comment']->getId()}/valid" ?> class="btn btn--pd-xs btn-bg-orange"><?= ($array['comment']->getValid())? "Annuler le commentaire" : "Valider le commentaire" ?></a>
          <?php endif; ?>
          
          <?php if (isset($_SESSION['tokenAuth']) && ("{$_SESSION['tokenAuth']}" === $array['comment']->getAuthorId()) || isset($admin) && $admin): ?>
            <a href=<?= "/blog/post-{$post->getId()}/comment-{$array['comment']->getId()}/delete" ?> class="btn btn--pd-xs btn-bg-red">Supprimer le commentaire</a>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
  <?php endif; ?>
</div>
