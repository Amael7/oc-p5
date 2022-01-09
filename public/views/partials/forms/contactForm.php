<h3>Vous pouvez me contacter ici</h3>

<div class="form-container"> 
  <form action="/contactForm" method="post" class="formulaire">
    <p><label for="visitorName">Votre nom prénom</label></p>
    <p><input type="text" name="visitorName" id="visitorName" placeholder="Votre nom prénom" required="required"></p>
    
    <p><label for="mailObject">Objet</label></p>
    <p><input type="text" name="mailObject" id="mailObject" placeholder="Objet" required="required"></p>
    
    <p><label for="visitorEmail">Votre Email</label></p>
    <p><input type="text" name="visitorEmail" id="visitorEmail" placeholder="Votre Email" required="required"></p>
    
    <p><label for="message">Votre message</label></p>
    <p><textarea name="message" id="message" cols="30" rows="7" required="required"></textarea></p>
    
    
    <p><button type="submit" class="btn">Envoyer</button></p>
  </form>
</div>

  <?php if (isset($_SESSION['contactFormSend'])): ?>
    <h2>Email Envoyé</h2>
  <?php endif; ?>