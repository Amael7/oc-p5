<div class="form-container">  
  <form action="/blog/<?= ($_POST == []) ? "post/new" : "post-$postId/edit" ?>" method="post" class="formulaire">
    <p><label for="title">Titre</label></p>
    <p><input type="text" name="title" id="title" placeholder="Titre" required="required" value="<?= ($_POST["title"])?? "" ?>"></p>

    <p><label for="subTitle">Sous-titre</label></p>
    <p><input type="text" name="subTitle" id="subTitle" placeholder="Sous-titre" required="required" value="<?= $_POST['subTitle']?? "" ?>"></p>
    
    <p><label for="content">Contenu</label></p>
    <p><textarea name="content" id="content" cols="15" rows="3" placeholder="Contenu" required="required"><?= $_POST['content']?? "" ?></textarea></p>
    
    <p><label for="photo">Photo</label></p>
    <p><input type="text" name="photo" id="photo" placeholder="Photo" required="required" value="<?= $_POST['photo']?? "" ?>"></p>

    <p><label for="authorId">Auteur</label></p>
    <select type="text" name="authorId" id="authorId" required="required">
      <option value="">--Merci de choisir un auteur--</option>
      <?php foreach($users as $user): ?>
        <option value="<?= $user->getId() ?>" <?= (isset($_POST['authorId']) && $_POST['authorId'] == $user->getId())? "selected" : "" ?>><?= $user->getFullName() ?></option>
      <?php endforeach; ?>
    </select>
      
    <?php if ($_POST == []): ?>
      <p><button type="submit" name="save" class="btn">Ajouter</button></p>
      <?php else: ?>
      <p><button type="submit" name="update" class="btn">Modifier</button></p>
    <?php endif; ?>
  </form>
</div>
