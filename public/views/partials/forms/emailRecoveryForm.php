<p>Renseignez votre adresse email pour recevoir un lien de renouvellement de votre mot de passe oublié</p>
<div class="form-container">
  <form action="/sendEmailPasswordRecovery" method="post" class="formulaire">
    <p><label for="email">Email</label></p>
    <p><input type="text" name="email" id="email" placeholder="Email" required="required"></p>
    
    <p><button type="submit" class="btn">Envoyer</button></p>
  </form>

  <?php if (isset($_SESSION['emailRecoverySend'])): ?>
    <h2>Email Envoyé</h2>
  <?php endif; ?>
</div>
