<p>Modification du mot de passe</p>
<div class="form-section"> 
  <form action="/passwordRecovery" method="post">
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" placeholder="Mot de passe" required="required">
    
    <label for="passwordCheck">Confirmer mot de passe</label>
    <input type="password" name="passwordCheck" id="passwordCheck" placeholder="Confirmer mot de passe" required="required">

    <button type="submit">Envoyer</button>
  </form>
</div>
