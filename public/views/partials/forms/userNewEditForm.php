<?= (isset($_SESSION['user_auth']))? "<h1>Modification du profil</h1>" : "<h1>Inscription</h1>" ?>
<div class="form-section"> 
  <form action="<?= ($_POST == []) ? "/registration" : '/blog/user-' . $user->getId() . '/edit' ?>" method="post">
    <?php if (isset($_SESSION['user_auth'])): ?>
      <label for="firstName">Prénom</label>
      <input type="text" name="firstName" id="firstName" placeholder="Prénom" required="required" value="<?= ($_POST["firstName"])?? "" ?>">
  
      <label for="lastName">Nom de famille</label>
      <input type="text" name="lastName" id="lastName" placeholder="Nom de famille" required="required" value="<?= ($_POST["lastName"])?? "" ?>">
    <?php endif; ?>
    
    <label for="email">Email</label>
    <input type="text" name="email" id="email" placeholder="Email" required="required" value="<?= ($_POST["email"])?? "" ?>">
    
    <?php if (isset($_SESSION['mdp'])): ?>
      <label for="password">Mot de passe</label>
      <input type="password" name="password" id="password" placeholder="Mot de passe" required="required">

      <label for="passwordCheck">Confirmer mot de passe</label>
      <input type="password" name="passwordCheck" id="passwordCheck" placeholder="Confirmer mot de passe" required="required">
    <?php endif; ?>

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