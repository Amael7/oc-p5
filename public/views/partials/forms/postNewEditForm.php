<div class="form-section">  
  <form action="/blog/<?= ($_POST == []) ? "post/new" : "post-$postId/edit" ?>" method="post">
    <label for="title">Titre</label>
    <input type="text" name="title" id="title" placeholder="Titre" required="required" value="<?= ($_POST["title"])?? "" ?>">

    <label for="subTitle">Sous-titre</label>
    <input type="text" name="subTitle" id="subTitle" placeholder="Sous-titre" required="required" value="<?= $_POST['subTitle']?? "" ?>">
    
    <label for="content">Contenu</label>
    <textarea name="content" id="content" cols="15" rows="3" required="required"><?= $_POST['content']?? "" ?></textarea>
    
    <label for="photo">Photo</label>
    <input type="text" name="photo" id="photo" placeholder="Photo" required="required" value="<?= $_POST['photo']?? "" ?>">

    <label for="authorId">Auteur</label>
    <select type="text" name="authorId" id="authorId" required="required">
      <option value="">--Merci de choisir un auteur--</option>
      <?php foreach($users as $user): ?>
        <option value="<?= $user->getId() ?>" <?= (isset($_POST['authorId']) && $_POST['authorId'] == $user->getId())? "selected" : "" ?>><?= $user->getFullName() ?></option>
      <?php endforeach; ?>
    </select>
      
    <?php if ($_POST == []): ?>
      <button type="submit" name="save">Ajouter</button>
      <?php else: ?>
      <button type="submit" name="update">Modifier</button>
    <?php endif; ?>
  </form>
</div>
