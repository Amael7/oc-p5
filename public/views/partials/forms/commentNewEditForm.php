<div class="form-section">  
  <form action="/blog/<?= ($_POST == []) ? "post-$postId/comment/new" : "post-$postId/comment-$commentId/edit" ?>" method="post">
    <label for="title">Titre</label>
    <input type="text" name="title" id="title" placeholder="Titre" required="required" value="<?= ($_POST["title"])?? "" ?>">

    <label for="content">Contenu</label>
    <textarea name="content" id="content" cols="15" rows="3" required="required"><?= $_POST['content']?? "" ?></textarea>
      
    <?php if ($_POST == []): ?>
      <button type="submit" name="save">Ajouter</button>
      <?php else: ?>
      <button type="submit" name="update">Modifier</button>
    <?php endif; ?>
  </form>
</div>
