<p>Renseignez votre adresse email pour recevoir un lien de renouvellement de votre mot de passe oublié</p>
<div class="form-section"> 
  <form action="/sendEmailPasswordRecovery" method="post">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" placeholder="Email" required="required">
    
    <button type="submit">Envoyer</button>
  </form>

  <?php if (isset($_SESSION['emailRecoverySend'])): ?>
    <h2>Email Envoyé</h2>
  <?php endif; ?>

  <?= ($_SESSION['flash']['success'])?? null; ?>
  <?= ($_SESSION['flash']['danger'])?? null; ?>
</div>
