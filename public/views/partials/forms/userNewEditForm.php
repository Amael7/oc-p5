<?php if (isset($_SESSION['user_auth'])): ?>
    <h1>Modification du profil</h1>
  <?php else: ?>
    <h1>Inscription</h1>
<?php endif; ?>
<div class="form-section"> 

  <form action="/blog/<?= ($_POST == []) ? "/registration" : '/blog/user-' . $user->getId() . '/edit' ?>" method="post">
    <?php if (isset($_SESSION['user_auth'])): ?>
      <label for="first_name">Prénom</label>
      <input type="text" name="first_name" id="first_name" placeholder="Prénom" required="required" value="<?= ($_POST["firstName"])?? "" ?>">
  
      <label for="last_name">Nom de famille</label>
      <input type="text" name="last_name" id="last_name" placeholder="Nom de famille" required="required" value="<?= ($_POST["lastName"])?? "" ?>">
    <?php endif; ?>
    
    <label for="email">Email</label>
    <input type="text" name="email" id="email" placeholder="Email" required="required" value="<?= ($_POST["email"])?? "" ?>">
    
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" placeholder="Mot de passe" required="required">

    <label for="password">Confirmer mot de passe</label>
    <input type="password" name="password" id="password" placeholder="Confirmer mot de passe" required="required">

    <?php if (isset($_SESSION['user_auth'])): ?>
      <label for="description">Description</label>
      <textarea name="description" id="description" cols="15" rows="3" placeholder="Description" required="required"><?= ($_POST["description"])?? "" ?></textarea>
    <?php endif; ?>

    <?php if ($_POST == []): ?>
      <button type="submit" name="save">Inscription</button>
      <?php else: ?>
      <button type="submit" name="update">Modifier</button>
    <?php endif; ?>
  </form>
</div>