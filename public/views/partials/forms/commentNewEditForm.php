<div class="form-container"> 
  <form action="/blog/<?= ($_POST == []) ? "post-$postId/comment/new" : "post-$postId/comment-$commentId/edit" ?>" method="post" class="formulaire">
    <p><label for="title">Titre</label></p>
    <p><input type="text" name="title" id="title" placeholder="Titre" required="required" value="<?= ($_POST["title"])?? "" ?>"></p>

    <p><label for="content">Contenu</label></p>
    <p><textarea name="content" id="content" cols="15" rows="3" required="required"><?= $_POST['content']?? "" ?></textarea></p>
      
    <?php if ($_POST == []): ?>
      <p><button type="submit" name="save" class="btn">Ajouter</button></p>
      <?php else: ?>
      <p><button type="submit" name="update" class="btn">Modifier</button></p>
    <?php endif; ?>
  </form>
</div>