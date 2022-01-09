<p>Connectez vous si vous avez déjà un compte </p>
<div class="form-container">
  <form action="/login" method="post" class="formulaire">
    <p><label for="email">Email</label></p>
    <p><input type="text" name="email" id="email" placeholder="Email" required="required"></p>
    
    <p><label for="password">Mot de passe</label></p>
    <p><input type="password" name="password" id="password" placeholder="Mot de passe" required="required"></p>
    
    <p><button type="submit" class="btn">Connexion</button></p>
  </form>
  <?= ($_SESSION['flash']['danger'])?? null; ?>
</div>
<a href="/registration">Créer un compte</a>
<a href="/emailRecoveryView">Mot de passe oublié</a>
