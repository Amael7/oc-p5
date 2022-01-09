<?= (isset($_SESSION['tokenAuth']))? "<h1>Modification du profil</h1>" : "<h1>Inscription</h1>" ?>
<div class="form-container"> 
  <form action="<?= ($_POST == []) ? "/registration" : '/user/edit' ?>" method="post" class="formulaire">
    <p><label for="firstName">Prénom</label></p>
    <p><input type="text" name="firstName" id="firstName" placeholder="Prénom" required="required" value="<?= ($_POST["firstName"])?? "" ?>"></p>
    
    <p><label for="lastName">Nom de famille</label></p>
    <p><input type="text" name="lastName" id="lastName" placeholder="Nom de famille" required="required" value="<?= ($_POST["lastName"])?? "" ?>"></p>
    
    <?php if (isset($_SESSION['tokenAuth'])): ?>
      <p><label for="description">Description</label></p>
      <p><textarea name="description" id="description" cols="15" rows="3" placeholder="Description" required="required"><?= ($_POST["description"])?? "" ?></textarea></p>
    <?php endif; ?>
    
    <p><label for="email">Email</label></p>
    <p><input type="text" name="email" id="email" placeholder="Email" required="required" value="<?= ($_POST["email"])?? "" ?>"></p>
    
    <?php if (isset($_SESSION['tokenAuth']) === false): ?>
      <p><label for="password">Mot de passe</label></p>
      <p><input type="password" name="password" id="password" placeholder="Mot de passe" required="required"></p>
      
      <p><label for="passwordCheck">Confirmer mot de passe</label></p>
      <p><input type="password" name="passwordCheck" id="passwordCheck" placeholder="Confirmer mot de passe" required="required"></p>
    <?php endif; ?>

    <p><button type="submit" class="btn"><?= (isset($_SESSION['tokenAuth']))? "Modifier" : "Inscription" ?></button></p>
  </form>
  <?php if (isset($_SESSION['tokenAuth'])): ?>
    <a href=<?= "/passwordRecovery" ?> class="btn btn-bg-orange" >Modifier le mot de passe</a>
  <?php endif; ?>
</div>