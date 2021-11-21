<p>Connectez vous si vous avez déjà un compte </p>
<div class="form-section"> 
  <form action="/login" method="post">
    
    <label for="email">Email</label>
    <input type="text" name="email" id="email" placeholder="Email" required="required">
    
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password" placeholder="Mot de passe" required="required">
    
    <button type="submit">Connexion</button>
  </form>
  <?= ($_SESSION['flash']['danger'])?? null; ?>
</div>
<a href="/registration">Créer un compte</a>
<a href="/emailRecoveryView">Mot de passe oublié</a>
