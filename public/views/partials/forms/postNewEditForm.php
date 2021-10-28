<div class="form-section">  
  <form action="/blog/post/new" method="post">
    <label for="title">Titre</label>
    <?php if (isset($_POST['title'])): ?>
      <input type="text" name="title" id="title" placeholder="Titre" required="required" value="<?= $_POST['title'] ?>">
      <?php else: ?>
      <input type="text" name="title" id="title" placeholder="Titre" required="required">
    <?php endif; ?>


        
    <label for="subTitle">Sous-titre</label>
    <?php if (isset($_POST['subTitle'])): ?>
      <input type="text" name="subTitle" id="subTitle" placeholder="Sous-titre" required="required" value="<?= $_POST['subTitle'] ?>">
      <?php else: ?>
      <input type="text" name="subTitle" id="subTitle" placeholder="Sous-titre" required="required">
    <?php endif; ?>
      
    <label for="content">Contenu</label>
    <?php if (isset($_POST['content'])): ?>
      <textarea name="content" id="content" cols="15" rows="3" required="required"><?= $_POST['content'] ?></textarea>
      <?php else: ?>
      <textarea name="content" id="content" cols="15" rows="3" required="required"></textarea>
    <?php endif; ?>
          
    <label for="photo">Photo</label>
    <?php if (isset($_POST['photo'])): ?>
      <input type="text" name="photo" id="photo" placeholder="Photo" value="<?= $_POST['photo'] ?>">
    <?php else: ?>
      <input type="text" name="photo" id="photo" placeholder="Photo">
    <?php endif; ?>
      
    <?php if ($_POST == []): ?>
      <button type="submit">Ajouter</button>
      <?php else: ?>
      <button type="submit">Modifier</button>
    <?php endif; ?>
  </form>
</div>
