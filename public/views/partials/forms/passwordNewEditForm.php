<p>Modification du mot de passe</p>
<div class="form-container"> 
  <form action="/passwordRecovery <?= (isset($_SESSION['tokenEmail'])) ? "-{$_SESSION['tokenEmail']}" : "" ?>" method="post" class="formulaire">
    <p><label for="password">Mot de passe</label></p>
    <p><input type="password" name="password" id="password" placeholder="Mot de passe" required="required"></p>
    
    <p><label for="passwordCheck">Confirmer mot de passe</label></p>
    <p><input type="password" name="passwordCheck" id="passwordCheck" placeholder="Confirmer mot de passe" required="required"></p>

    <p><button type="submit" class="btn">Envoyer</button></p>
  </form>
</div>
